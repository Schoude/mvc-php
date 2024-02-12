<?php

use Core\App;
use Core\Database;
use Core\Response;
use Core\Session;
use Http\Forms\NoteForm;
use Http\Models\Note;

$db = App::resolve(Database::class);

// Get the note of the user.
$currentUserId = Session::get('user')['id'];
$note = Note::getWithRelation($_POST['id'], $currentUserId);

if (!$note) {
  abort(Response::NOT_FOUND);
}

// Validate the input
$form = NoteForm::validate($attributes = [
  'body' => $_POST['body']
]);

// NO errors = update record
Note::update($note['id'], $attributes['body']);

redirect('/notes');
