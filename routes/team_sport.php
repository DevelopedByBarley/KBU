<?php

use App\Controllers\TeamSportController;

// route_group -> /team_sports
$r->addRoute('GET', '/{team-refId}', [TeamSportController::class, 'all']);
$r->addRoute('POST', '', [TeamSportController::class, 'storeTeamSport']);
