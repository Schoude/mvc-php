<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);

$currentUserId = Session::get('user')['id'];

$note = $db->query(
  'select * from notes where id = :noteId',
  [
    ':noteId' => $_GET['id'],
  ]
)->findOrFail();

authorize($note['user_id'] === $currentUserId);

view('notes/edit.view.php', [
  'heading' => 'Edit Note',
  'note' => $note,
  'errors' => Session::get('errors') ?? [],
]);
