<?php

use Core\App;
use Core\Database;
use Core\Session;

$currentUserId = Session::get('user')['id'];

$db = App::resolve(Database::class);
$notes = $db->query('select * from notes where user_id = :userId', [
  ':userId' => $currentUserId,
])->get();

$heading = 'My Notes';

view('notes/index.view.php', [
  'heading' => $heading,
  'notes' => $notes,
]);
