<?php

namespace Http\Models;

use Core\App;
use Core\Database;
use Core\Session;

class Note
{
  public function __construct(protected string $body)
  {
  }

  public function save(): self
  {
    $currentUserId = Session::get('user')['id'];

    /** @var Database $db */
    $db = App::resolve(Database::class);

    $db->query('INSERT INTO notes (body, user_id) VALUES (:body, :userId)', [
      ':body' => $this->body,
      ':userId' => $currentUserId,
    ]);

    return $this;
  }
}
