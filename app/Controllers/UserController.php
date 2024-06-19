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

  public function registerPage()
  {
    session_start();


    $user = $_SESSION["userId"] ?? null;

    if ($user) {
      header("Location: /user/dashboard");
      exit;
    }


    echo $this->Render->write("public/Layout.php", [
      "content" => $this->Render->write("public/pages/user/Register.php", [
        "csrf" => $this->CSRFToken
      ])
    ]);
  }



  public function store()
  {
    session_start();
    $this->CSRFToken->check();

    $isSuccess = $this->User->storeUser($_POST, $_FILES);

    if (!$isSuccess) {
      $this->Toast->set('Regisztráció sikertelen, próbálja meg más adatokkal!', 'danger', '/user/register', null);
    }

    $this->Toast->set('Regisztráció sikeres!', 'success', '/user/login', null);
  }

}
