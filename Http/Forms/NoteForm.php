<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class NoteForm
{
  protected $errors = [];

  public function __construct(public array $attributes)
  {
    if (!Validator::string($this->attributes['body'], 1, 500)) {
      $this->errors['body'] = 'A body of no more than 500 characters is required is required.';
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
