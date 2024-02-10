<?php

namespace Core;

use Core\Response;

class Router
{
  protected $routes = [];

  public function add(string $requestMethod, string $uri, string $controllerPath)
  {
    $this->routes[] = [
      'uri' => $uri,
      'controller' => $controllerPath,
      'method' => $requestMethod
    ];
  }

  public function get(string $uri, string $controllerPath)
  {
    $this->add('GET', $uri, $controllerPath);
  }

  public function post(string $uri, string $controllerPath)
  {
    $this->add('POST', $uri, $controllerPath);
  }

  public function delete(string $uri, string $controllerPath)
  {
    $this->add('DELETE', $uri, $controllerPath);
  }

  public function patch(string $uri, string $controllerPath)
  {
    $this->add('PATCH', $uri, $controllerPath);
  }

  public function put(string $uri, string $controllerPath)
  {
    $this->add('PUT', $uri, $controllerPath);
  }

  public function route(string $uri, string $requestMethod)
  {
    foreach ($this->routes as $route) {
      if ($route['uri'] === $uri && $route['method'] === strtoupper($requestMethod)) {
        return require base_path($route['controller']);
      }
    }

    $this->abort();
  }

  protected function abort(int $code = Response::NOT_FOUND)
  {
    http_response_code($code);

    view("{$code}.php");

    die();
  }
}
