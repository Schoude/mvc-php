<?php

/**
 * This dumps the content of the
 * required file into this file
 */
require './functions.php';

// require './router.php';

require './Database.php';

/**
 * require() as a function saves the value returned from * a php file.
 * This is similar to 'export' in a JS module.
 */
$config = require('./config.php');

$db = new Database($config['database']);

// PDO::FETCH_ASSOC returns only the associative array values ('id' => 1, 'name' => 'Test')
// and not the indexed ([0] => 1, [1] => 'Test') values
$posts = $db->query('select * from posts')->fetchAll();

foreach ($posts as $post) {
  echo "<li>{$post['title']}</li>";
}
