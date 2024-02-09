<?php

$config = require('./config.php');
$db = new Database($config['database']);

$heading = 'New Note';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $errors = [];

  if (strlen($_POST['body']) === 0) {
    $errors['body'] = 'A body is required.';
  }

  if (strlen($_POST['body']) > 500) {
    $errors['body'] = 'The body cannot be more than 1,000 characters long.';
  }

  if (empty($errors)) {
    $db->query('INSERT INTO notes (body, user_id) VALUES (:body, :userId)', [
      ':body' => $_POST['body'],
      ':userId' => 1,
    ]);
  }
}

require './views/note-create.view.php';
