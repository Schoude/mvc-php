<?php

$path = parse_url($_SERVER['REQUEST_URI'])['path'];
$routes = require(base_path('routes.php'));

function routeToController(string $path, array $routes)
{
  if (array_key_exists($path, $routes)) {
    require $routes[$path];
  } else {
    abort();
  }
}

function abort(int $code = Response::NOT_FOUND)
{
  http_response_code($code);

  require base_path("views/{$code}.php");

  die();
}

routeToController($path, $routes);
