<?php

use Core\Router;
use Core\Session;
use Core\ValidationException;

/**
 * Sets 'PHPSESSID' cookie in the browser and creates a file
 * on the server thats stores information about the session
 *
 * This happens for laragon in this dir `F:\laragon\tmp`
 *
 * If a cookie is present, it loads the data from the existing session file.
 */
session_start();

const BASE_PATH = __DIR__ . '/../';

/**
 * This dumps the content of the
 * required file into this file
 */
require BASE_PATH . 'Core/functions.php';

/**
 * Class instantiations trigger the registered callback.
 * Also calls to static methods or class constants trigger the registered callback.
 * Then we can required the called class on the fly.
 *
 * The '$class' argument is the fully qualified class name with all the namespaces.
 * => Folder structure MUST map the namespacing including case sensitivity.
 */
spl_autoload_register(function ($class) {
  // Might turn 'Core\Database' into 'Core/Database' (Mac & Linux).
  $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
  require base_path("{$class}.php");
});

require base_path('bootstrap.php');

$router = new Router();

$routes = require(base_path('routes.php'));
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
try {
  $router->route($uri, $method);
} catch (ValidationException $e) {
  Session::flash('errors', $e->errors);
  Session::flash('old', $e->old);

  return redirect($router->previousUrl());
}

// After navigation, delete the flash session data for that page.
Session::unflash();
