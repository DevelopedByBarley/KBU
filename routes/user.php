<?php

use App\Controllers\UserController;

// route_group -> /

// Statikus útvonalak
$r->addRoute('GET', '/register', [UserController::class, 'registerPage']);
$r->addRoute('GET', '/login', [UserController::class, 'loginPage']);
$r->addRoute('GET', '/dashboard', [UserController::class, 'index']);
$r->addRoute('GET', '/delete', [UserController::class, 'destroy']);
$r->addRoute('GET', '/reset-pair', [UserController::class, 'resetPair']);

// Dinamikus útvonalak
$r->addRoute('GET', '/{duel-sportId}', [UserController::class, 'getAllUsersWhoFreeByDuelId']);
$r->addRoute('POST', '/pw-compare/{userId}', [UserController::class, 'comparePwForPairingUsers']);

// POST útvonalak
$r->addRoute('POST', '/register', [UserController::class, 'store']);
$r->addRoute('POST', '/login', [UserController::class, 'login']);
$r->addRoute('POST', '/logout', [UserController::class, 'logout']);
