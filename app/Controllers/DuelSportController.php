<?php

namespace App\Controllers;

use App\Models\DuelSport;
use Exception;
use PDO;

class DuelSportController extends Controller
{
    private $DuelSport;

    public function __construct()
    {
        parent::__construct();
        $this->DuelSport = new DuelSport();
    }
    public function storeDuelSport()
    {
        try {
            $this->DuelSport->store($_POST);
            http_response_code(200);
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
                $users = $this->Model->selectAllByRecord('users', 'duel_sportRef_id', $duel_sport['id'], PDO::PARAM_INT);
                (int)$duel_sports[$index]['max'] -= count($users);
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
