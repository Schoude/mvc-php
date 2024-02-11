<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class LoginForm
{
  protected $errors = [];

  public function __construct(public array $attributes)
  {
    if (!Validator::email($this->attributes['email'])) {
      $this->errors['email'] = 'Please provide a valid email address.';
    }

    if (!Validator::string($this->attributes['password'])) {
      $this->errors['password'] = 'Please provide a valid password.';
    }
  }

  public static function validate(array $attributes): self
  {
    $instance = new static($attributes);

    if ($instance->failed()) {
      ValidationException::throw($instance->errors(), $instance->attributes);
    }

    return $instance;
  }

  public function failed(): bool
  {
    return count($this->errors());
  }

  public function error(string $field, string $message): void
  {
    $this->errors[$field] = $message;
  }

  public function errors()
  {
    return $this->errors;
  }
}
