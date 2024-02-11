<?php

use Core\App;
use Core\Authenticator;
use Core\Database;
use Http\Forms\LoginForm;

$email = $_POST['email'];
$password = $_POST['password'];

/** @var Database $db */
$db = App::resolve(Database::class);

// Vaildate form inputs
$form = new LoginForm();

if (!$form->validate($email, $password)) {
  return view('session/create.view.php', [
    'errors' => $form->errors(),
  ]);
}

$auth = new Authenticator();

if ($auth->attempt($email, $password)) {
  header('Location: /');
  die();
} else {
  return view('session/create.view.php', [
    'errors' => [
      'email' => 'No matching account found for this email address and password.'
    ],
  ]);
}
