<?php

use Core\App;
use Core\Session;

/** @var \Twig\Environment $twig */
$twig = App::resolve('twig');

$template = $twig->load('index.twig');

echo $template->render([
  'currentUrl' => $_SERVER['REQUEST_URI'],
  'loggedIn' => Session::get('user') ?? false,
]);
