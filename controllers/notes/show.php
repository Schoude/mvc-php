<?php

/**
 * require() as a function saves the value returned from * a php file.
 * This is similar to 'export' in a JS module.
 */
$config = require(base_path('config.php'));
$db = new Database($config['database']);

$currentUserId = 1;
$heading = 'Note Detail';

$note = $db->query(
  'select * from notes where id = :noteId',
  [
    ':noteId' => $_GET['id'],
  ]
)->findOrFail();

authorize($note['user_id'] === $currentUserId);

view('notes/show.view.php', [
  'heading' => $heading,
  'note' => $note,
]);
