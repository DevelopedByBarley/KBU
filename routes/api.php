<?php

use App\Controllers\MainTeamsController;

// route_group ->/api/


$r->addRoute('GET', '/main-teams', [MainTeamsController::class, 'getMainTeams']);
