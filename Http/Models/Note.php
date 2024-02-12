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

  public static function delete(string $noteId): bool
  {

    $currentUserId = Session::get('user')['id'];

    /** @var Database $db */
    $db = App::resolve(Database::class);

    // TODO: move to get() function
    // First check if the user owns the note.
    $note = $db->query(
      'select * from notes where id = :noteId',
      [
        ':noteId' => $noteId,
      ]
    )->find();

    if (!$note) {
      return false;
    }
    // until here

    if ($note['user_id'] !== $currentUserId) {
      return false;
    }

    // Delete the note of the user.
    $db->query('delete from notes where id = :id', [
      ':id' => $noteId,
    ]);

    return true;
  }
}
