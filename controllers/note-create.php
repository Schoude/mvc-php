<?php

require './Validator.php';

$config = require('./config.php');
$db = new Database($config['database']);

$heading = 'New Note';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $errors = [];

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

require './views/note-create.view.php';
