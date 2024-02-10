<?php

namespace Core;

use Core\Container;

/**
 * Static App 'Singleton' that stores the container
 * for app-wide services like the DB client etc.
 */
class App
{
  protected static Container $container;

  public static function setContainer(Container $container)
  {
    static::$container = $container;
  }

  public static function container()
  {
    return static::$container;
  }

  public static function bind(string $key, callable $resolver)
  {
    static::container()->bind($key, $resolver);
  }

  public static function resolve(string $key): mixed
  {
    return static::container()->resolve($key);
  }
}
