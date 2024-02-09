<?php

/**
 * require() as a function saves the value returned from * a php file.
 * This is similar to 'export' in a JS module.
 */
$config = require('./config.php');

$db = new Database($config['database']);


$note = $db->query(
  'select * from notes where id = :noteId',
  [
    ':noteId' => $_GET['id'],
  ]
)->fetch();

if (!$note) {
  abort();
}

$currentUserId = 1;

if ($note['user_id'] !== $currentUserId) {
  // 403 = Forbidden
  abort(Response::FORBIDDEN);
}

$heading = 'Note Detail';

require 'views/note.view.php';
