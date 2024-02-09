<?php

/**
 * require() as a function saves the value returned from * a php file.
 * This is similar to 'export' in a JS module.
 */
$config = require('./config.php');

$db = new Database($config['database']);

$notes = $db->query('select * from notes where user_id = 1')->fetchAll();

$heading = 'My Notes';

require 'views/notes.view.php';
