<?php

use Core\App;
use Core\Database;
use Core\Session;
use Core\Validator;
use Http\Forms\NoteForm;

$form = NoteForm::validate($attributes = [
  'body' => $_POST['body']
]);

// Add Note class
$currentUserId = Session::get('user')['id'];

$db = App::resolve(Database::class);

$db->query('INSERT INTO notes (body, user_id) VALUES (:body, :userId)', [
  ':body' => $attributes['body'],
  ':userId' => $currentUserId,
]);

header('Location: /notes');
die();
