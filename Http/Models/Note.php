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

  public static function allWithRelation(string $userId): array
  {
    /** @var Database $db */
    $db = App::resolve(Database::class);

    $notes = $db->query('select * from notes where user_id = :userId', [
      ':userId' => $userId,
    ])->get();

    return $notes;
  }

  public static function get(string $noteId): array
  {
    /** @var Database $db */
    $db = App::resolve(Database::class);

    $note = $db->query(
      'select * from notes where id = :noteId',
      [
        ':noteId' => $noteId,
      ]
    )->find();

    if (!$note) {
      throw new \Exception('Note does not exist.');
    }

    return $note;
  }

  public static function getWithRelation(string $noteId, string $userId): array|bool
  {
    /** @var Database $db */
    $db = App::resolve(Database::class);

    $note = $db->query(
      'select * from notes where id = :noteId and user_id = :userId',
      [
        ':noteId' => $noteId,
        ':userId' => $userId,
      ]
    )->find();

    if (!$note) {
      return false;
    }

    return $note;
  }

  public static function delete(string $noteId): bool
  {
    $currentUserId = Session::get('user')['id'];

    /** @var Database $db */
    $db = App::resolve(Database::class);

    $note = static::getWithRelation($noteId, $currentUserId);

    if (!$note) {
      return false;
    }

    // Delete the note of the user.
    $db->query('delete from notes where id = :id', [
      ':id' => $noteId,
    ]);

    return true;
  }

  public static function update(string $noteId, string $body)
  {
    /** @var Database $db */
    $db = App::resolve(Database::class);

    $db->query('update notes set body = :body where id = :noteId', [
      ':noteId' => $noteId,
      ':body' => $body,
    ]);
  }
}
