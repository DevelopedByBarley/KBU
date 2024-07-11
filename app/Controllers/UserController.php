<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\User;
use Exception;

class UserController extends Controller
{
  private $User;

  public function __construct()
  {
    $this->User = new User();
    parent::__construct();
  }

  public function comparePwForPairingUsers($vars)
  {
    $userId = $vars['userId'] ?? null;
    $_POST = json_decode(file_get_contents('php://input'), true);

    try {
      $isSuccess = $this->User->compare($_POST, $userId);
      http_response_code(200);
      echo json_encode($isSuccess);
    } catch (Exception $e) {
      http_response_code(500);
      echo "Internal Server Error" . $e->getMessage();
      exit;
    }
  }

  public function getAllUsersWhoFreeByDuelId($vars)
  {

    try {
      $users = $this->User->getAllUsersByDuelSportId($vars['duel-sportId']);
      http_response_code(200);
      echo json_encode($users);
    } catch (Exception $e) {
      http_response_code(500);
      echo "Internal Server Error" . $e->getMessage();
      exit;
    }
  }

  public function index()
  {
    $userId = $this->Auth->checkUserIsLoggedInOrRedirect('userId', '/user/login');

    echo $this->Render->write("public/Layout.php", [
      "csrf" => $this->CSRFToken,
      "content" => $this->Render->write("public/pages/user/Dashboard.php", [
        "user" => $this->Model->show('users', $userId)

      ])
    ]);
  }




  public function store()
  {
     $this->CSRFToken->check();

    try {
      $last_inserted_id = $this->User->storeUser($_POST, $_FILES);

      if (!$last_inserted_id) {
        $this->Alert->set('Regisztráció sikertelen, próbálja meg más adatokkal!', 'red-500', '/', null);
      }

      $tokenData = $this->generateExpiresTokenByDays(10);
      $reset_url = $this->createResetUrl($tokenData);



      $this->Model->storeToken($tokenData['token'], $tokenData['expires'], '/reset', $last_inserted_id);
      $this->Mailer->renderAndSend('newUser', [
        'user_name' => $_POST['name'] ?? 'problem',
        'reset_url' => $reset_url  ?? 'problem',
        'pair_password' => $_POST['password'] ?? null
      ], $_POST['email'], 'Visszaigazolás a regisztrációról.');
      $this->Alert->set('Regisztráció sikeres, az e-mail címedre visszaigazoló levelet küldtünk!', 'green-500', '/', null);
    } catch (Exception $e) {
      http_response_code(500);
      echo "Internal Server Error" . $e->getMessage();
      exit;
    }
  }


  public function destroy()
  {

    try {
      $token_data = $this->Model->checkResetToken();

      if (!$token_data) {
        http_response_code(400);
        $this->Toast->set('Ez a token lejárt vagy nem létezik!', 'danger', '/', null);
      }
      $user_id  = $token_data['ref_id'];
      $token = $token_data['token'];
      $this->User->deleteUser($user_id);
      $this->Model->deletePairRefIdIfItExist($user_id);

      $deactivated = $this->Model->deactivateResetToken($token);

      if (!$deactivated) {
        http_response_code(400);
        $this->Toast->set('Ez a token lejárt vagy nem létezik!', 'danger', '/', null);
      }

      http_response_code(200);
      $this->Toast->set('Felhasználó sikeresen törölve.', 'cyan-500', '/', null);
    } catch (Exception $e) {
      http_response_code(500);
      echo "Internal Server Error" . $e->getMessage();
      exit;
    }
  }

  public function resetPair()
  {
    try {
      $token_data = $this->Model->checkResetToken();
      $user_id  = $token_data['ref_id'];
      $token = $token_data['token'];
      $this->User->deletePairRefIdIfItExist($user_id);
      $this->Model->deactivateResetToken($token);
      http_response_code(200);
      $this->Toast->set('Pár törlése sikeres', 'cyan-500', '/', null);
    } catch (Exception $e) {
      http_response_code(500);
      echo "Internal Server Error" . $e->getMessage();
      exit;
    }
  }
}
