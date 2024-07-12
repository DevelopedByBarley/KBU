<?php

namespace App\Controllers;

use App\Models\MainTeam;
use Exception;
use PDO;

class MainTeamController extends Controller
{
    private $MainTeam;

    public function __construct()
    {
        parent::__construct();
        $this->MainTeam = new MainTeam();
    }

    public function storeMainTeam()
    {
        try {
            $this->MainTeam->store($_POST);
            http_response_code(200);
            $this->Toast->set('Fő csapat sikeresen hozzáadva!', 'teal-500', '/admin/main-teams', null);
        } catch (Exception $e) {
            http_response_code(500);
            error_log("Adatbázis hiba: " . $e->getMessage());
            $this->Toast->set('Fő csapat hozzáadása sikertelen!', 'red-500', '/admin/main-teams', null);

        }
    }
}
