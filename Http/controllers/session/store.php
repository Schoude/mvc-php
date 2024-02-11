<?php

use Core\Authenticator;
use Core\Session;
use Core\ValidationException;
use Http\Forms\LoginForm;

try {
  $form = LoginForm::validate($attributes = [
    'email' => $_POST['email'],
    'password' => $_POST['password'],
  ]);
} catch (ValidationException $e) {
  Session::flash('errors', $e->errors);
  Session::flash('old', $e->old);

  return redirect('/login');
}

if ((new Authenticator)->attempt($attributes['email'], $attributes['password'])) {
  redirect('/');
}

$form->error('email', 'No matching account found for this email address and password.');

return redirect('/login');
