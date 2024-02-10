<?php

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

$router = new \Core\Router();

$routes = require(base_path('routes.php'));
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);
