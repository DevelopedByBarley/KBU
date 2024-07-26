<?php

namespace App\Controllers;

use App\Models\AdminActivity;
use App\Models\TeamSport;
use Exception;
use PDO;

class TeamSportController extends Controller
{
    private $TeamSport;
    private $Activity;

    public function __construct()
    {
        parent::__construct();
        $this->TeamSport = new TeamSport();
        $this->Activity = new AdminActivity();
    }

    public function storeTeamSport()
    {
        $adminId = $this->Auth::checkUserIsLoggedInOrRedirect('adminId', '/admin');
        try {

            $sport = $this->TeamSport->store($_POST);
            http_response_code(200);
            $this->Activity->store([
                'content' => "Hozzá adott egy új csapat sportot: $sport csapat.",
                'contentInEn' => null,
                'adminRefId' => $adminId
            ],  $adminId);
            $this->Toast->set('Csapatsport sikeresen hozzáadva!', 'teal-500', '/admin/team-sports', null);
        } catch (Exception $e) {
            http_response_code(500);
            error_log("Adatbázis hiba: " . $e->getMessage());
            $this->Toast->set('Csapatsport hozzáadása sikertelen!', 'red-500', '/admin/team-sports', null);
        }
    }


    public function all($vars)
    {
        try {
            $team_sports = $this->Model->selectAllByRecord('team_sports', 'main_teamRef_id', $vars['team-refId'], PDO::PARAM_INT);
            foreach ($team_sports as $index => $team_sport) {
                $max =  (int)$team_sports[$index]['max'];

                $users = $this->Model->selectAllByRecord('users', 'team_sportRef_id', $team_sport['id'], PDO::PARAM_INT);
                $team_sports[$index]['currentMax']  = $max -= count($users);
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
