<?php

namespace App\Controllers;

use App\Models\AdminActivity;
use App\Models\DuelSport;
use Exception;
use PDO;

class DuelSportController extends Controller
{
    private $DuelSport;
    private $Activity;


    public function __construct()
    {
        parent::__construct();
        $this->DuelSport = new DuelSport();
        $this->Activity = new AdminActivity();
    }
    public function storeDuelSport()
    {
        $adminId = $this->Auth::checkUserIsLoggedInOrRedirect('adminId', '/admin');

        try {
            $sport = $this->DuelSport->store($_POST);
            http_response_code(200);
            $this->Activity->store([
                'content' => "Hozzá adott egy új páros sportot: $sport csapat.",
                'contentInEn' => null,
                'adminRefId' => $adminId
            ],  $adminId);
            $this->Toast->set('Páros sport sikeresen hozzáadva!', 'teal-500', '/admin/duel-sports', null);
        } catch (Exception $e) {
            http_response_code(500);
            error_log("Adatbázis hiba: " . $e->getMessage());
            $this->Toast->set('Páros sport hozzáadása sikertelen!', 'red-500', '/admin/duel-sports', null);
        }
    }


    public function all($vars)
    {
        try {
            $duel_sports = $this->Model->selectAllByRecord('duel_sports', 'main_teamRef_id', $vars['team-refId'], PDO::PARAM_INT);
            foreach ($duel_sports as $index => $duel_sport) {
                $max =  (int)$duel_sports[$index]['max'];
                $users = $this->Model->selectAllByRecord('users', 'duel_sportRef_id', $duel_sport['id'], PDO::PARAM_INT);
                $duel_sports[$index]['currentMax']  = $max -= count($users);
                $duel_sports[$index]['users'][] = $users;
            }


            http_response_code(200);
            echo  json_encode($duel_sports);
        } catch (Exception $e) {
            http_response_code(500);
            echo "Internal Server Error" . $e->getMessage();
            exit;
        }
    }
}
