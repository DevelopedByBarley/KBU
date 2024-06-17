<?php

namespace App\Models;

use App\Models\Model;
use Exception;
use PDO;
use PDOException;

class MainTeam extends Model
{

    public function getMainTeams() {
        $main_teams = self::all('main_teams');
    }
    
}
