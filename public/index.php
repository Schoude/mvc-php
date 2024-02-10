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
 */
spl_autoload_register(function ($class) {
  require base_path("Core/{$class}.php");
});

require base_path('Core/router.php');
