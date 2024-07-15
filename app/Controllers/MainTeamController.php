<?php

namespace App\Controllers;

use App\Models\AdminActivity;
use App\Models\MainTeam;
use Exception;
use PDO;

class MainTeamController extends Controller
{
    private $MainTeam;
    private $Activity;


    public function __construct()
    {
        parent::__construct();
        $this->MainTeam = new MainTeam();
        $this->Activity = new AdminActivity();
    }

    public function storeMainTeam()
    {
        $adminId = $this->Auth::checkUserIsLoggedInOrRedirect('adminId', '/admin');
        
        try {
            $team = $this->MainTeam->store($_POST);
            http_response_code(200);
            $this->Activity->store([
                'content' => "Hozzá adott egy új fő csapatot: $team csapat.",
                'contentInEn' => null,
                'adminRefId' => $adminId
            ],  $adminId);
            $this->Toast->set('Fő csapat sikeresen hozzáadva!', 'teal-500', '/admin/main-teams', null);
        } catch (Exception $e) {
            http_response_code(500);
            error_log("Adatbázis hiba: " . $e->getMessage());
            $this->Toast->set('Fő csapat hozzáadása sikertelen!', 'red-500', '/admin/main-teams', null);
        }
    }
}
