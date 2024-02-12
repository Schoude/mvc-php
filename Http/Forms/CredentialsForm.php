<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class CredentialsForm
{
  protected $errors = [];

  public function __construct(public array $attributes)
  {
    if (!Validator::email($this->attributes['email'])) {
      $this->errors['email'] = 'Please provide a valid email address.';
    }

    if (!Validator::string($this->attributes['password'], 3, 255)) {
      $this->errors['password'] = 'Please provide a valid password.';
    }
  }

  public static function validate(array $attributes): self
  {
    $instance = new static($attributes);

    return $instance->failed() ?
      $instance->throw() :
      $instance;
  }

  public function throw ()
  {
    ValidationException::throw($this->errors(), $this->attributes);
  }

  public function failed(): bool
  {
    return count($this->errors());
  }

  public function error(string $field, string $message): self
  {
    $this->errors[$field] = $message;

    return $this;
  }

  public function errors()
  {
    return $this->errors;
  }
}
