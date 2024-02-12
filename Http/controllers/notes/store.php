<?php

use Http\Forms\NoteForm;
use Http\Models\Note;

$form = NoteForm::validate($attributes = [
  'body' => $_POST['body']
]);

$note = (new Note($attributes['body']))->save();

if (!$note) {
  $form
    ->error('note', 'Could not create note.')
    ->throw();
}

redirect('/notes');
