<?php

use Core\App;
use Core\Database;
use Core\Session;
use Http\Models\Note;

$db = App::resolve(Database::class);

/** @var \Twig\Environment $twig */
$twig = App::resolve('twig');

$template = $twig->load('notes/index.twig');

$user = Session::get('user');

$notes = Note::allWithRelation($user['id']);

echo $template->render([
  'title' => 'My Notes',
  'heading' => 'My Notes',
  'loggedIn' => $user ?? false,
  'currentUrl' => $_SERVER['REQUEST_URI'],
  'notes' => $notes
]);
