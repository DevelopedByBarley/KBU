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


}
