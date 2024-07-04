<?php

use App\Controllers\DuelSportController;

// route_group -> /main-teams

$r->addRoute('GET', '', [DuelSportController::class, '']);
