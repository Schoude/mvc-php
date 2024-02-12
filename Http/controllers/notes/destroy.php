<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);

$currentUserId = Session::get('user')['id'];

// First check if the user owns the note.
$note = $db->query(
  'select * from notes where id = :noteId',
  [
    ':noteId' => $_POST['id'],
  ]
)->findOrFail();

authorize($note['user_id'] === $currentUserId);

// Delete the note of the user.
$db->query('delete from notes where id = :id', [
  ':id' => $_POST['id'],
]);

// Redirect to /notes
header('Location: /notes');

die();
