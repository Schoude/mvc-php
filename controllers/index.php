<?php

$_SESSION['name'] = 'Marc';

view(
  'index.view.php',
  [
    'heading' => 'Home',
  ]
);
