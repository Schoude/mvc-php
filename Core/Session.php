<?php

namespace Core;

class Session
{
  public static function has(string $key): bool
  {
    return (bool) static::get($key);
  }

  public static function put(string $key, mixed $value)
  {
    $_SESSION[$key] = $value;
  }

  public static function get(string $key, mixed $default = null): mixed
  {
    return $_SESSION['_flash'][$key] ??
      $_SESSION[$key] ??
      $default;
  }

  public static function flush()
  {
    // Clear the super global
    $_SESSION = [];
  }

  public static function destroy()
  {
    static::flush();

    // Destroy the session file on the server
    session_destroy();

    // Clear the brower cookie -> set the expiration.
    $cookieParams = session_get_cookie_params();
    setcookie(
      'PHPSESSID',
      "",
      // Time in the past = instant expiration
      time() - 3600,
      $cookieParams['path'],
      $cookieParams['domain'],
      $cookieParams['secure'],
      $cookieParams['httponly'],
    );
  }

  public static function flash(string $key, mixed $value)
  {
    $_SESSION['_flash'][$key] = $value;
  }

  public static function unflash()
  {
    unset($_SESSION['_flash']);
  }
}
