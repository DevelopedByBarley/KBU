<?php

use App\Controllers\Controller;

// route_group -> /


$r->addRoute('GET', '', [Controller::class, 'index']);
$r->addRoute('GET', 'register', [Controller::class, 'register']);
$r->addRoute('GET', 'cookie-info', [Controller::class, 'cookie']);
$r->addRoute('POST', 'test', [Controller::class, 'test']);
