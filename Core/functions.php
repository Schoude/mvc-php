<?php

use Core\Response;
use Core\Session;

function dd(mixed $var)
{
  echo '<pre>';
  var_dump($var);
  echo '</pre>';
  die();
}

function urlIs(string $value): bool
{
  return $_SERVER['REQUEST_URI'] === $value;
}

function abort(int $code = Response::NOT_FOUND)
{
  http_response_code($code);

  view("{$code}.php");

  die();
}

function authorize(bool $isAuthorized, int $statusCode = Response::FORBIDDEN)
{
  if (!$isAuthorized) {
    abort($statusCode);
  }
}

function base_path(string $path): string
{
  return BASE_PATH . $path;
}

/**
 * Loads a view with the given attributes.
 */
function view(string $view, array $attributes = [])
{
  // Import variables into the current symbol table from an array.
  // => makes values declared in an assoc array available as variables
  extract($attributes);

  require base_path("views/{$view}");
}

function redirect(string $path)
{
  header("Location: $path");
  die();
}

function old(string $key, mixed $default = ''): mixed
{
  return Session::get('old')[$key] ?? $default;
}
