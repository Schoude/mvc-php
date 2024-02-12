<?php

use Core\Session;

view('notes/create.view.php', [
  'heading' => 'New Note',
  'errors' => Session::get('errors') ?? [],
]);
