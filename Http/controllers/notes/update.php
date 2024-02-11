<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$currentUserId = 1;

$note = $db->query(
  'select * from notes where id = :noteId',
  [
    ':noteId' => $_POST['id'],
  ]
)->findOrFail();

authorize($note['user_id'] === $currentUserId);

// Validate form
$errors = [];

if (!Validator::string($_POST['body'], 1, 500)) {
  $errors['body'] = 'A body of no more than 500 characters is required is required.';
}

// Validation issue -> send back to edit page.
if (count($errors)) {
  return view('notes/edit.view.php', [
    'heading' => 'Edit Note',
    'errors' => $errors,
    'note' => $note,
  ]);
}

// NO errors = update record
$db->query('update notes set body = :body where id = :noteId', [
  ':body' => $_POST['body'],
  ':noteId' => $_POST['id'],
]);

// Redirect to the notes overview
header('Location: /notes');

die();
