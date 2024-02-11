<?php

use Core\App;
use Core\Database;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];

// Vaildate inputs
$errors = [];

if (!Validator::email($email)) {
  $errors['email'] = 'Please provide a valid email address.';
}

if (!Validator::string($password, 7, 255)) {
  $errors['password'] = 'The password has to be between 7 and 255 characters long.';
}

if (!empty($errors)) {
  return view('registration/create.view.php', [
    'errors' => $errors,
  ]);
}

// Check if user email already exists
/** @var Database $db */
$db = App::resolve(Database::class);

$foundUser = $db->query(
  'select * from users where email = :email',
  [
    ':email' => $email,
  ]
)->find();

// Y -> redirect to login page.
if ($foundUser) {
  // header('Location: /login');
  header('Location: /');
  die();
}

// N -> save to the db
$db->query(
  'insert into users (email, password) values (:email, :password)',
  [
    ':email' => $email,
    ':password' => $password,
  ]
)->find();

// mark that the user has logged in (i.e. started a session)
// $_SESSION['logged_in'] = true;
$_SESSION['user'] = [
  'email' => $email,
];

//redirect to the home page '/'
header('Location: /');
die();
