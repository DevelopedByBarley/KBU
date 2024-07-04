<?php

use App\Controllers\TeamSportController;

// route_group -> /main-teams

$r->addRoute('GET', '', [TeamSportController::class, '']);
