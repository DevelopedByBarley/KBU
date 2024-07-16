<?php
use App\Controllers\AdminController;
use App\Controllers\AdminRender;

// route_group -> /admin


//Renders
$r->addRoute('GET', '', [AdminController::class, 'loginPage']);
$r->addRoute('GET', '/dashboard', [AdminController::class, 'index']);
$r->addRoute('GET', '/table', [AdminController::class, 'table']);
$r->addRoute('GET', '/sports', [AdminController::class, 'sports']);
$r->addRoute('GET', '/main-teams', [AdminController::class, 'mainTeams']);
$r->addRoute('GET', '/team-sports', [AdminController::class, 'teamSports']);
$r->addRoute('GET', '/duel-sports', [AdminController::class, 'duelSports']);
$r->addRoute('GET', '/form', [AdminController::class, 'form']);
$r->addRoute('GET', '/settings', [AdminController::class, 'settings']);
$r->addRoute('GET', '/mailbox', [AdminController::class, 'mailbox']);
$r->addRoute('GET', '/export-registers', [AdminController::class, 'exportRegistrations']);


// Operations

$r->addRoute('POST', '/login', [AdminController::class, 'login']);
$r->addRoute('POST', '/logout', [AdminController::class, 'logout']);
$r->addRoute('POST', '/store', [AdminController::class, 'store']);
$r->addRoute('POST', '/update', [AdminController::class, 'update']);
$r->addRoute('POST', '/delete/{id}', [AdminController::class, 'delete']);
$r->addRoute('POST', '/delete-user/{id}', [AdminController::class, 'deleteUserById']);
$r->addRoute('POST', '/new-token/{id}', [AdminController::class, 'sendNewTokenForUser']);
