<?php

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

function authorize(bool $isAuthorized, int $statusCode = Response::FORBIDDEN)
{
  if (!$isAuthorized) {
    abort($statusCode);
  }
}
