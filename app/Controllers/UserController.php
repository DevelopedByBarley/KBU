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
    
    $isSuccess = $this->User->storeUser($_POST, $_FILES);

    if (!$isSuccess) {
      $this->Alert->set('Regisztráció sikertelen, próbálja meg más adatokkal!', 'red-500', '/', null);
    }

    $this->Alert->set('Regisztráció sikeres, az e-mail címedre visszaigazoló levelet küldtünk!', 'green-500', '/', null);
  }

}
