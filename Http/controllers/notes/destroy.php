<?php

use Core\ValidationException;
use Http\Models\Note;


$deleted = Note::delete($_POST['id']);

if (!$deleted) {
  throw ValidationException::throw(
    [
      'body' => 'Note deletion failed.',
    ],
    []
  );
}

redirect('/notes');
