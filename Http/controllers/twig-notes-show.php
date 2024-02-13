<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);

$user = Session::get('user');

$note = $db->query(
  'select * from notes where id = :noteId',
  [
    ':noteId' => $_GET['id'],
  ]
)->findOrFail();

authorize($note['user_id'] === $user['id']);

/** @var \Twig\Environment $twig */
$twig = App::resolve('twig');

$template = $twig->load('notes/show.twig');

echo $template->render([
  'title' => 'Note Detail',
  'heading' => 'Note Detail',
  'loggedIn' => $user ?? false,
  'currentUrl' => $_SERVER['REQUEST_URI'],
  'note' => $note,
]);
