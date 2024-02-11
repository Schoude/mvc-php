<?php

use Core\App;
use Core\Database;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];

/** @var Database $db */
$db = App::resolve(Database::class);

// Vaildate inputs
$errors = [];

if (!Validator::email($email)) {
  $errors['email'] = 'Please provide a valid email address.';
}

if (!Validator::string($password)) {
  $errors['password'] = 'Please provide a valid password.';
}

if (!empty($errors)) {
  return view('sessions/create.view.php', [
    'errors' => $errors,
  ]);
}

// Match the credentials
// 1) Find the user
$user = $db->query('select * from users where email = :email', [
  ':email' => $email,
])->find();

if (!$user) {
  return view('sessions/create.view.php', [
    'errors' => [
      'email' => 'No matching account found for this email address.'
    ],
  ]);
}

// 2) Compare the passwords
if (!password_verify($password, $user['password'])) {
  return view('sessions/create.view.php', [
    'errors' => [
      'email' => 'No matching account found for this email address and password.'
    ],
  ]);
}

login([
  'email' => $email
]);

header('Location: /');
die();
