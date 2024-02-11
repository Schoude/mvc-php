<?php

namespace Http\Forms;

use Core\Validator;

class LoginForm
{
  protected $errors = [];

  public function validate(string $email, string $password): bool
  {
    if (!Validator::email($email)) {
      $this->errors['email'] = 'Please provide a valid email address.';
    }

    if (!Validator::string($password)) {
      $this->errors['password'] = 'Please provide a valid password.';
    }

    return empty($errors);
  }

  public function errors()
  {
    return $this->errors;
  }
}
