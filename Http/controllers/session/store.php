<?php

use Core\Authenticator;
use Http\Forms\CredentialsForm;

$form = CredentialsForm::validate($attributes = [
  'email' => $_POST['email'],
  'password' => $_POST['password'],
]);

$authenticated = (new Authenticator)->attempt(
  $attributes['email'],
  $attributes['password'],
);

if (!$authenticated) {
  $form
    ->error(
      'email',
      'No matching account found for this email address and password.',
    )
    ->throw();
}

redirect('/');
