<?php

/**
 * This dumps the content of the
 * required file into this file
 */
require __DIR__ . '/../' . 'functions.php';

dd('THIS IS INDEX!');

/**
 * Has to be loaded first!
 * The router depends on it!
 */
require './Database.php';
require './Response.php';

require './router.php';
