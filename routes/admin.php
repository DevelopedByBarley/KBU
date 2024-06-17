<?php
use App\Controllers\AdminController;

// route_group -> /admin


//Renders
$r->addRoute('GET', '', [AdminController::class, 'loginPage']);
$r->addRoute('GET', '/dashboard', [AdminController::class, 'index']);

$r->addRoute('POST', '/login', [AdminController::class, 'login']);
$r->addRoute('POST', '/store', [AdminController::class, 'store']);
$r->addRoute('POST', '/logout', [AdminController::class, 'logout']);