<?php

use App\Controllers\MainTeamsController;

// route_group ->/main-teams/


$r->addRoute('GET', '', [MainTeamsController::class, 'getMainTeams']);
