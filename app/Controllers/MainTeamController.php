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
}
