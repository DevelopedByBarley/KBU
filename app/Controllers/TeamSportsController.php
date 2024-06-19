<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\MainTeam;
use App\Models\TeamSport;
use Exception;

class TeamSportsController extends Controller
{
    private $TeamSport;
    public function __construct()
    {
        parent::__construct();
        $this->TeamSport = new TeamSport();
    }

    public function getTeamSportsByMainTeam($vars)
    {
        $mainTeamId = $vars['mainTeamId'] ?? null;
    }
}
