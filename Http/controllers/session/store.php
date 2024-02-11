<?php

use Core\Authenticator;
use Http\Forms\LoginForm;

$form = LoginForm::validate($attributes = [
  'email' => $_POST['email'],
  'password' => $_POST['password'],
]);

if ((new Authenticator)->attempt($attributes['email'], $attributes['password'])) {
  redirect('/');
}

$form->error('email', 'No matching account found for this email address and password.');

return redirect('/login');
