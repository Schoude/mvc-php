<?php

use Core\Response;
use Core\Session;
use Http\Models\Note;

$currentUserId = Session::get('user')['id'];

$note = Note::getWithRelation($_GET['id'], $currentUserId);

if (!$note) {
  abort(Response::NOT_FOUND);
}

view('notes/edit.view.php', [
  'heading' => 'Edit Note',
  'note' => $note,
  'errors' => Session::get('errors') ?? [],
]);
