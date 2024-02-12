<?php

namespace Core;

use Core\Middleware\Middleware;
use Core\Response;

class Router
{
  protected $routes = [];

  public function add(string $requestMethod, string $uri, string $controllerPath)
  {
    $this->routes[] = [
      'uri' => $uri,
      'controller' => $controllerPath,
      'method' => $requestMethod,
      'middleware' => null,
    ];

    return $this;
  }

  public function get(string $uri, string $controllerPath)
  {
    return $this->add('GET', $uri, $controllerPath);
  }

  public function post(string $uri, string $controllerPath)
  {
    return $this->add('POST', $uri, $controllerPath);
  }

  public function delete(string $uri, string $controllerPath)
  {
    return $this->add('DELETE', $uri, $controllerPath);
  }

  public function patch(string $uri, string $controllerPath)
  {
    return $this->add('PATCH', $uri, $controllerPath);
  }

  public function put(string $uri, string $controllerPath)
  {
    return $this->add('PUT', $uri, $controllerPath);
  }

  public function only(string $key)
  {
    $this->routes[array_key_last($this->routes)]['middleware'] = $key;

    return $this;
  }

  public function route(string $uri, string $requestMethod)
  {
    foreach ($this->routes as $route) {
      if ($route['uri'] === $uri && $route['method'] === strtoupper($requestMethod)) {
        // Apply registered middleware
        // Null checks are handled within the resolve method
        Middleware::resolve($route['middleware']);

        return require base_path("Http/controllers/{$route['controller']}");
      }
    }
  }

  public function previousUrl(): string
  {
    return $_SERVER['HTTP_REFERER'] ?? '';
  }

  protected function abort(int $code = Response::NOT_FOUND)
  {
    http_response_code($code);

    view("{$code}.php");

    die();
  }
}
