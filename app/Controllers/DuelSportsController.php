<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\DuelSport;
use App\Models\TeamSport;
use Exception;

class DuelSportsController extends Controller
{
    private $DuelSport;
    public function __construct()
    {
        parent::__construct();
        $this->DuelSport = new DuelSport();
    }
}
