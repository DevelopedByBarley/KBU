<?php

use App\Controllers\TeamSportsController;

// route_group ->/team-sports/


$r->addRoute('GET', '/{mainTeamId}', [TeamSportsController::class, 'getTeamSportsByMainTeam']);
