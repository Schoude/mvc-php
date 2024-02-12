<?php

use Core\App;
use Core\Session;

/** @var \Twig\Environment $twig */
$twig = App::resolve('twig');

$template = $twig->load('registration/create.twig');

$user = Session::get('user');

echo $template->render([
  'title' => 'Register',
  'heading' => 'Register TWIG',
  'loggedIn' => $user ?? false,
  'currentUrl' => $_SERVER['REQUEST_URI'],
  // 'userEmail' => $user['email'] ?? 'Guest',
]);
