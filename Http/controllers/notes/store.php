<?php

use Core\App;
use Core\Database;
use Core\Session;
use Core\Validator;

$db = App::resolve(Database::class);

$errors = [];

if (!Validator::string($_POST['body'], 1, 500)) {
  $errors['body'] = 'A body of no more than 500 characters is required is required.';
}

// Validation issue -> send back to create page.
if (!empty($errors)) {
  return view('notes/create.view.php', [
    'heading' => 'New Note',
    'errors' => $errors,
  ]);
}

$currentUserId = Session::get('user')['id'];

$db->query('INSERT INTO notes (body, user_id) VALUES (:body, :userId)', [
  ':body' => $_POST['body'],
  ':userId' => $currentUserId,
]);

header('Location: /notes');
die();
