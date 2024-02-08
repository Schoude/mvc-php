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

if (array_key_exists('id', $_GET)) {
  $id = $_GET['id'];

  if (isset($id)) {
    // Wildcard parameters that are replaced by the execute
    // method on the prepared SQL stament. Two different ways.
    // $query = 'select * from posts where id = ?';
    $query = 'select * from posts where id = :id';
    $posts = $db->query($query, [
      // The three ways to define the wildcard replacement.
      // $id,
      // 'id' => $id,
      ':id' => $id,
    ])->fetchAll();
  }
} else {
  $query = 'select * from posts';
  $posts = $db->query($query)->fetchAll();
}

foreach ($posts as $post) {
  echo "<li>{$post['title']}</li>";
}
