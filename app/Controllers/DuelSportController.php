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
}
