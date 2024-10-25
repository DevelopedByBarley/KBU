<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Helpers\Toast;
use App\Helpers\Validator;
use App\Models\User;
use Exception;
use PDO;

class UserController extends Controller
{
  private $User;

  public function __construct()
  {
    $this->User = new User();
    parent::__construct();
  }

  public function updatePairByToken($vars)
  {
    $user_id = (int)$vars['userId'] ?? null;
    $pair_id = (int)$_POST['pair-id'] ?? null;

    if (!$user_id || !$pair_id) {
      var_dump($_SERVER['HTTP_REFERER']);
      $this->Toast->set('Pár lefoglalása sikertelen ha szükséges kérjük adjon meg jelszót vagy próbálja meg újra!', 'red-500', $_SERVER['HTTP_REFERER'], null);
    }

    try {
      $this->User->updatePair($user_id, $pair_id);
      $this->Toast->set('Pár lefoglalása sikeres!', 'cyan-400', '/', null);
    } catch (Exception $e) {
      http_response_code(500);
      echo "Internal Server Error" . $e->getMessage();
      exit;
    }
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

    $userId = $vars['userId'] ?? null;
    $duel_sport_id = $vars['duel-sportId'] ?? null;

    try {
      $users = $this->User->getAllUsersByDuelSportId($duel_sport_id, $userId);
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
    //$this->CSRFToken->check();
    try {
      $main_team_id  = filter_var($_POST['main-team'] ?? null, FILTER_SANITIZE_SPECIAL_CHARS);
      $team_sport_id  = filter_var($_POST['team-sport'] ?? null, FILTER_SANITIZE_SPECIAL_CHARS);
      $duel_sport_id  = filter_var($_POST['duel-sport'] ?? null, FILTER_SANITIZE_SPECIAL_CHARS);

      $main_team = $this->Model->selectByRecord('main_teams', 'id', $main_team_id, PDO::PARAM_INT);
      $team_sport = $this->Model->selectByRecord('team_sports', 'id', $team_sport_id, PDO::PARAM_INT);
      $duel_sport = $this->Model->selectByRecord('duel_sports', 'id', $duel_sport_id, PDO::PARAM_INT);

      $validator = new Validator();
      $validators  = [
        'ident_number' => [
          'value' => $_POST['ident-number'],
          'validators' => [
            'required' => true,
            'minLength' => 6,
            'maxLength' => 8,
            'checkIsIdentityNumExist' => true
          ]
        ],
      ];

      $validated = $validator->validate($validators);
      $hasValidateErrors = $this->hasValidateErrors($validated); // Itt már ha vannak gondok kiirja true-val és lehet dobni a sessionbe;

      if ($hasValidateErrors) {
        $this->Toast->set('Regisztráció során hibás adatokat adott meg, kérjük próbája meg újra', 'danger', '/', null);
        exit;
      }

      $last_inserted_id = $this->User->storeUser($_POST, $_FILES);

      if (!$last_inserted_id) {
        $this->Alert->set('Regisztráció sikertelen, próbálja meg más adatokkal!', 'red-500', '/', null);
        exit;
      }

      /*       $tokenData = $this->generateExpiresTokenByDays(10);
      $reset_url = $this->createResetUrl($tokenData);
      $this->Model->storeToken($tokenData['token'], $tokenData['expires'], '/reset', $last_inserted_id); */

      $this->Mailer->renderAndSend('newUser', [
        'user_name' => $_POST['name'] ?? 'problem',
        'pair_password' => $_POST['password'] ?? null,
        'main_team' => $main_team,
        'team_sport' => $team_sport,
        'duel_sport' => $duel_sport,
      ], $_POST['email'], 'Visszaigazolás a regisztrációról.');



      $this->Alert->set('Regisztráció sikeres, az e-mail címedre visszaigazoló levelet küldtünk!', 'green-500', '/', null);
    } catch (Exception $e) {
      http_response_code(500);
      var_dump("Adatbázis hiba: " . $e->getMessage());
      exit;
      error_log("Adatbázis hiba: " . $e->getMessage());
      $this->Toast->set('Sikertelen regisztráció! Általános szerver hiba, vagy az adott erőforrás nem található. Kérjük próbálja meg újra vagy forduljon egy adminhoz!', 'red-500', '/', null);
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

      $user_mail = $this->Model->selectByRecord('users', 'id', $user_id, PDO::PARAM_INT)['email'];
      $pair_mail = $this->Model->selectByRecord('users', 'pairRef_id', $user_id, PDO::PARAM_INT)['email'];

      $this->Mailer->renderAndSend('UserNotify', [
        'message' => $message ?? "Ezúton tájékoztatunk hogy a $user_mail e-mail címmel rendelkező felhasználó törölt a párjai közül. emiatt a pár státuszodat szabaddá tettük. Ha változtatni szeretnél akkor kérd az adminok segítségét"
      ], $pair_mail, 'Üzenet!');


      $this->Model->deletePairRefIdIfItExist($user_id);
      $this->User->deleteUser($user_id);

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
      $user_mail = $this->Model->selectByRecord('users', 'id', $user_id, PDO::PARAM_INT)['email'];
      $pair_mail = $this->Model->selectByRecord('users', 'pairRef_id', $user_id, PDO::PARAM_INT)['email'];

      $this->Mailer->renderAndSend('UserNotify', [
        'message' => $message ?? "Ezúton tájékoztatunk hogy a $user_mail e-mail címmel rendelkező felhasználó törölte a regisztrációt, vagy téged párjai közül. ezért a pár státuszodat szabaddá tettük. Ha változtatni szeretnél akkor kérd az adminok segítségét"
      ], $pair_mail, 'Üzenet!');


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

  public function checkUserIsExist()
  {
    try {
      $this->sanitizePost();
      $ident_number = $_POST['identNumber'] ?? null;
      $user = $this->Model->selectByRecord('users', 'ident_number', $ident_number, PDO::PARAM_INT);
      http_response_code(200);;
      echo json_encode($user);
    } catch (Exception $e) {
      http_response_code(500);
      echo "Internal Server Error" . $e->getMessage();
      exit;
    }
  }

  public function sendMail()
  {
    $email = $_POST['email'] ?? null;
    $message = $_POST['message'] ?? null;


    try {
      $this->Mailer->renderAndSend('MessageMail', [
        'mail' =>  $email ?? 'problem',
        'message' => $message ?? 'problem'
      ], $_SERVER['MESSAGE_MAIL_ADDRESS'], 'Üzenet!');

      $this->Toast->set('Üzenet sikeresen elküldve!', 'teal-500', '/', null);
    } catch (\Throwable $th) {
      $this->Toast->set('Üzenet sikeresen sikertelen!', 'red-500', '/', null);
    }
  }
}
