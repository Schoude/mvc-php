<?php

use Core\Database;
use Core\Validator;

$config = require(base_path('config.php'));
$db = new Database($config['database']);

$heading = 'New Note';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!Validator::string($_POST['body'], 1, 500)) {
    $errors['body'] = 'A body of no more than 500 characters is required is required.';
  }

  if (empty($errors)) {
    $db->query('INSERT INTO notes (body, user_id) VALUES (:body, :userId)', [
      ':body' => $_POST['body'],
      ':userId' => 1,
    ]);
  }
}

view('notes/create.view.php', [
  'heading' => $heading,
  'errors' => $errors,
]);
