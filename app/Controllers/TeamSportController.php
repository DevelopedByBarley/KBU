<?php

namespace App\Controllers;

use App\Models\TeamSport;
use Exception;
use PDO;

class TeamSportController extends Controller
{
    private $TeamSport;

    public function __construct()
    {
        parent::__construct();
        $this->TeamSport = new TeamSport();
    }

    public function all($vars)
    {
        try {
            $team_sports = $this->Model->selectAllByRecord('team_sports', 'main_teamRef_id', $vars['team-refId'], PDO::PARAM_INT);
            foreach ($team_sports as $index => $team_sport) {
                $users = $this->Model->selectAllByRecord('users', 'team_sportRef_id', $team_sport['id'], PDO::PARAM_INT);
                (int)$team_sports[$index]['max'] -= count($users);
                $team_sports[$index]['users'][] = $users;
            }


            http_response_code(200);
            echo  json_encode($team_sports);
        } catch (Exception $e) {
            http_response_code(500);
            echo "Internal Server Error" . $e->getMessage();
            exit;
        }
    }
}
