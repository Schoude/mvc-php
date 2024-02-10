<?php

namespace Core;

class Container
{
  protected $bindings = [];

  public function bind(string $key, callable $resolver)
  {
    $this->bindings[$key] = $resolver;
  }

  public function resolve(string $key): mixed
  {
    if (!array_key_exists($key, $this->bindings)) {
      throw new \Exception("'$key' not bound to the Container");
    }

    return call_user_func($this->bindings[$key]);
  }
}
