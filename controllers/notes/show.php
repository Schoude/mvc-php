<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

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
