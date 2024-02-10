<?php

use Core\Database;

/**
 * require() as a function saves the value returned from * a php file.
 * This is similar to 'export' in a JS module.
 */
$config = require(base_path('config.php'));
$db = new Database($config['database']);

$notes = $db->query('select * from notes where user_id = 1')->get();

$heading = 'My Notes';

view('notes/index.view.php', [
  'heading' => $heading,
  'notes' => $notes,
]);
