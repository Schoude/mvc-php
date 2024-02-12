<?php

use Core\App;
use Core\Session;

/** @var \Twig\Environment $twig */
$twig = App::resolve('twig');

$template = $twig->load('index.twig');

$user = Session::get('user');

echo $template->render([
  'title' => 'Home',
  'currentUrl' => $_SERVER['REQUEST_URI'],
  'heading' => 'Home',
  'loggedIn' => $user ?? false,
  'userEmail' => $user['email'] ?? 'Guest',
]);
