<?php

$router->get('/', 'controllers/index.php');
$router->get('/about', 'controllers/about.php');
$router->get('/contact', 'controllers/contact.php');

// Notes
$router->get('/notes', 'controllers/notes/index.php');
// Note
// View routes
$router->get('/note', 'controllers/notes/show.php');
$router->get('/note/create', 'controllers/notes/create.php');
$router->get('/note/edit', 'controllers/notes/edit.php');
// Interaction routes
$router->post('/note', 'controllers/notes/store.php');
$router->patch('/note', 'controllers/notes/update.php');
$router->delete('/note', 'controllers/notes/destroy.php');


$router->get('/register', 'controllers/registration/create.php');
$router->post('/register', 'controllers/registration/store.php');
