<?php

use Core\App;
use Core\Database;
use Http\Forms\CredentialsForm;

$form = CredentialsForm::validate($attributes = [
  'email' => $_POST['email'],
  'password' => $_POST['password'],
]);

// Check if user email already exists
// /** @var Database $db */
// $db = App::resolve(Database::class);

// $foundUser = $db->query(
//   'select * from users where email = :email',
//   [
//     ':email' => $attributes['email'],
//   ]
// )->find();

// // Y -> redirect to login page.
// if ($foundUser) {
//   // header('Location: /login');
//   header('Location: /');
//   die();
// }

// // N -> save to the db
// $db->query(
//   'insert into users (email, password) values (:email, :password)',
//   [
//     ':email' => $attributes['email'],
//     ':password' => password_hash($attributes['password'], PASSWORD_BCRYPT),
//   ]
// )->find();

// // mark that the user has logged in (i.e. started a session)
// login([
//   'email' => $attributes['email']
// ]);

// //redirect to the home page '/'
// header('Location: /');
// die();
