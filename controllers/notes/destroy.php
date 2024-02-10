<?php

use Core\Database;

/**
 * require() as a function saves the value returned from * a php file.
 * This is similar to 'import' in a JS module.
 */
$config = require(base_path('config.php'));
$db = new Database($config['database']);

$currentUserId = 1;

// First check if the user owns the note.
$note = $db->query(
  'select * from notes where id = :noteId',
  [
    ':noteId' => $_POST['id'],
  ]
)->findOrFail();

authorize($note['user_id'] === $currentUserId);

// Delete the note of the user.
$db->query('delete from notes where id = :id', [
  ':id' => $_POST['id'],
]);

// Redirect to /notes
header('Location: /notes');

die();
