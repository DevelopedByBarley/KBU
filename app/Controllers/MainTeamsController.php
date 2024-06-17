<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\MainTeam;
use Exception;

class MainTeamsController extends Controller
{
    private $MainTeam;
    public function __construct()
    {
        parent::__construct();
        $this->MainTeam = new MainTeam();
    }

    public function getMainTeams()
    {
        try {
            $main_teams  = $this->MainTeam->getMainTeams();
            http_response_code(200);
            echo json_encode($main_teams);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'status' => false,
                'message' => 'Adatbázis műveleti hiba, kérjük próbálkozzon később.',
                'dev' => $e->getMessage()
            ]);
        }
    }
}
