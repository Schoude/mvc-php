<?php

const BASE_PATH = __DIR__ . '/../';

/**
 * This dumps the content of the
 * required file into this file
 */
require BASE_PATH . 'functions.php';

/**
 * Has to be loaded first!
 * The router depends on it!
 */
require base_path('Database.php');
require base_path('Response.php');
require base_path('router.php');
