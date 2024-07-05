<?php

use App\Controllers\DuelSportController;

// route_group -> /duel_sports

$r->addRoute('GET', '/{team-refId}', [DuelSportController::class, 'all']);
