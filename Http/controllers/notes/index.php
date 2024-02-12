<?php

use Core\App;
use Core\Database;
use Core\Session;
use Http\Models\Note;

$currentUserId = Session::get('user')['id'];

$db = App::resolve(Database::class);
$notes = Note::allWithRelation($currentUserId);

$heading = 'My Notes';

view('notes/index.view.php', [
  'heading' => $heading,
  'notes' => $notes,
]);
