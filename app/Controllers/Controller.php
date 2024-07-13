<?php

namespace App\Controllers;

use App\Helpers\Alert;
use App\Helpers\Authenticate;
use App\Helpers\CSRFToken;
use App\Helpers\Debug;
use App\Helpers\Mailer;
use App\Helpers\Render;
use App\Helpers\Toast;
use App\Helpers\UUID;
use App\Helpers\XLSX;
use App\Models\MainTeam;
use App\Models\Model;
use App\Models\Visitor;
use PDO;

class Controller
{
  protected $Model;
  protected $Debug;
  protected $Auth;
  protected $Render;
  protected $XLSX;
  protected $UUID;
  protected $Alert;
  protected $Toast;
  protected $CSRFToken;
  protected $Mailer;
  private $MainTeam;


  public function __construct()
  {
    $this->Model = new Model();
    $this->Debug = new Debug();
    $this->Auth = new Authenticate();
    $this->Render = new Render();
    $this->XLSX = new XLSX();
    $this->UUID = new UUID();
    $this->Alert = new Alert();
    $this->Toast = new Toast();
    $this->CSRFToken = new CSRFToken();
    $this->Mailer = new Mailer();
    $this->MainTeam = new MainTeam();
  }



  public function testMail()
  {
    $this->Model->sendMail();
  }
  public function test()
  {
    $visitor = new Visitor();

    $is_admin_url = strpos($_SERVER['REQUEST_URI'], '/admin') !== false;

    // Ellenőrizd, hogy a SAVING_VISITOR_PERM definiálva van-e és igaz-e
    if (defined('SAVING_VISITOR_PERM') && SAVING_VISITOR_PERM && !$is_admin_url) {
      $visitor->addVisitor();
    }


    echo $this->Render->write("public/Layout.php", [
      "content" => $this->Render->write("public/pages/Test.php", [])
    ]);
  }


  public function index()
  {
    $main_teams = $this->MainTeam->getAllMainTeamsWithUsers();
    echo $this->Render->write("public/Layout.php", [
      "content" => $this->Render->write("public/pages/Welcome.php", [
        'main_teams' => $main_teams,
        "csrf" => $this->CSRFToken
      ])
    ]);
  }


  public function reset()
  {
    $userId = $this->Model->checkResetToken()['ref_id'];
    $user = $this->Model->selectByRecord('users', 'id', $userId, PDO::PARAM_INT);
    echo $this->Render->write("public/Layout.php", [
      "content" => $this->Render->write("public/pages/Reset.php", [
        'user' => $user
      ])
    ]);
  }

  public function cookie()
  {
    echo $this->Render->write("public/Layout.php", [
      "content" => $this->Render->write("public/pages/Cookie_Info.php", [])
    ]);
  }

  public function error()
  {
    echo $this->Render->write("public/Layout.php", [
      "content" => $this->Render->write("public/pages/404.php", [])
    ]);
  }



  public function redirectByState($isSuccess, $success_url, $failed_url)
  {
    if ($isSuccess) {
      header("Location: $success_url");
      exit;
    } else {
      header("Location: $failed_url");
      exit;
    }
  }

  public function createResetUrl($tokenData)
  {
    return BASE_URL . '/reset?token=' . urlencode($tokenData['token']) . '&expires=' . urlencode($tokenData['expires']);
  }

  public function generateExpiresTokenByDays($days)
  {
    $token = bin2hex(random_bytes(16));
    $expires = time() + ($days * 24 * 60 * 60);
    return [
      'token' => $token,
      'expires' => $expires,
    ];
  }

  public function generateExpiresTokenByHours($hours)
  {
    $token = bin2hex(random_bytes(16));
    $expires = time() + ($hours * 60 * 60);
    return [
      'token' => $token,
      'expires' => $expires,
    ];
  }

  protected function getIpByUser()
  {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
      return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
      return $_SERVER['REMOTE_ADDR'];
    }
  }

  protected function setCookieWithExpiry($name, $value, $expiry)
  {
    $expiryTime = time() + ($expiry);
    setcookie($name, $value, $expiryTime, "/");
  }

  protected function sanitizePost()
  {
    $_POST = json_decode(file_get_contents('php://input'), true);
  }

  protected function hasValidateErrors($data)
  {
      foreach ($data as $key => $value) {
          if (is_array($value)) {
              if (isset($value['status']) && $value['status'] === false) {
                  return true;
              } elseif (self::hasValidateErrors($value)) {
                  return true;
              }
          }
      }
      return false;
  }
  
}
