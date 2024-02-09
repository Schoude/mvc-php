<?php

$path = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = [
  '/' => './controllers/index.php',
  '/about' => './controllers/about.php',
  '/notes' => './controllers/notes.php',
  '/note' => './controllers/note.php',
  '/contact' => './controllers/contact.php',
];

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

  require "./views/{$code}.php";

  die();
}

routeToController($path, $routes);
