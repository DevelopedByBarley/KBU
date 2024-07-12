<?php

use App\Controllers\MainTeamController;

// route_group -> /main-teams

$r->addRoute('GET', '', [MainTeamController::class, '']);
$r->addRoute('POST', '', [MainTeamController::class, 'storeMainTeam']);
