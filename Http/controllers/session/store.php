<?php

use Core\App;
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

// Match the credentials
// 1) Find the user
$user = $db->query('select * from users where email = :email', [
  ':email' => $email,
])->find();

if ($user) {
  // Email is correct

  // 2) Compare the passwords
  if (password_verify($password, $user['password'])) {
    // Password is correct, so login the user and redirect to home.
    login([
      'email' => $email
    ]);

    header('Location: /');
    die();
  }
}

// Email and/or password are incorrect.
return view('session/create.view.php', [
  'errors' => [
    'email' => 'No matching account found for this email address and password.'
  ],
]);
