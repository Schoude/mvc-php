<?php

use Core\Authenticator;
use Http\Forms\CredentialsForm;

$form = CredentialsForm::validate($attributes = [
  'email' => $_POST['email'],
  'password' => $_POST['password'],
]);

$registered = (new Authenticator)->attemptRegister(
  $attributes['email'],
  $attributes['password'],
);

if (!$registered) {
  $form
    ->error(
      'register',
      'Could not complete the registration.'
    )
    ->throw();
}

redirect('/register');
