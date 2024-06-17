<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Admin;
use Exception;

class AdminController extends Controller
{
  private $Admin;

  public function __construct()
  {
    $this->Admin = new Admin();
    parent::__construct();
  }


  public function loginPage()
  {
    session_start();

    $admin = $_SESSION["adminId"] ?? null;

    if ($admin) {
      header("Location: /admin/dashboard");
      exit;
    }


    echo $this->Render->write("admin/Layout.php", [
      "content" => $this->Render->write("admin/pages/Login.php", [
        "csrf" => $this->CSRFToken
      ])
    ]);
  }

  public function store()
  {
    $this->CSRFToken->check();

    $this->Admin->storeAdmin($_POST);
  }

  public function login()
  {
    session_start();
    $this->CSRFToken->check();
    try {
      $adminId = $this->Admin->loginAdmin($_POST);

      if ($adminId) {
        session_write_close(); // Bezárjuk a sessiont
        $session_timeout = 6000;
        session_set_cookie_params($session_timeout, '/', '', true, true); // secure és httponly flag beállítása
        session_start();
        session_regenerate_id(true);
        $_SESSION['adminId'] = $adminId;
        header('Location: /admin/dashboard');
        exit;
      } else {
        $this->Toast->set('Sikertelen belépés, hibás felhasználónév vagy jelszó', 'danger', '/admin', null);
      }
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }





  public function logout()
  {
    try {
      $this->CSRFToken->check();
      session_start();
      session_destroy();
      session_regenerate_id(true);

      $cookieParams = session_get_cookie_params();
      setcookie(session_name(), "", 0, $cookieParams["path"], $cookieParams["domain"], $cookieParams["secure"], isset($cookieParams["httponly"]));

      header("Location: /admin");
      exit();
    } catch (Exception $e) {
      http_response_code(500);
      echo "Internal Server Error" . $e->getMessage();
      return;
    }
  }

  public function index()
  {
    $this->Auth::checkUserIsLoggedInOrRedirect('adminId', '/admin');

    echo $this->Render->write("admin/Layout.php", [
      "content" => $this->Render->write("admin/pages/Dashboard.php", [
        "csrf" => $this->CSRFToken
      ])
    ]);
  }
}
