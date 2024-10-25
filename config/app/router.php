<?php

use App\Controllers\Controller;

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
  registerRoutes($r);
});

function registerRoutes(FastRoute\RouteCollector $router)
{
  $router->addGroup('/', function (FastRoute\RouteCollector $r) {
    require_once 'routes/home.php';
  });
  $router->addGroup('/main-teams', function (FastRoute\RouteCollector $r) {
    require_once 'routes/main_team.php';
  });
  $router->addGroup('/team-sports', function (FastRoute\RouteCollector $r) {
    require_once 'routes/team_sport.php';
  });
  $router->addGroup('/duel-sports', function (FastRoute\RouteCollector $r) {
    require_once 'routes/duel_sport.php';
  });
  $router->addGroup('/feedback', function (FastRoute\RouteCollector $r) {
    require_once 'routes/feedback.php';
  });
  $router->addGroup('/admin', function (FastRoute\RouteCollector $r) {
    if (ADMIN_SERVICE_PERM) {
      require_once 'routes/admin.php';
    }
  });
  $router->addGroup('/user', function (FastRoute\RouteCollector $r) {
    if (USER_SERVICE_PERM) {
      require_once 'routes/user.php';
    }
  });
}



// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
  $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
  case FastRoute\Dispatcher::NOT_FOUND:
    $Controller = new Controller();

    header("HTTP/1.0 404 Not Found");
    $Controller->error();
    break;
  case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
    $allowedMethods = $routeInfo[1];
    // ... 405 Method Not Allowed
    break;
  case FastRoute\Dispatcher::FOUND:
    $handler = $routeInfo[1];
    $vars = $routeInfo[2];
    $handlerInstance = new $handler[0]();
    $handlerInstance->{$handler[1]}($vars);
    break;
}
