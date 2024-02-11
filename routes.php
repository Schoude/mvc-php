<?php

$router->get('/', 'index.php');
$router->get('/about', 'about.php');
$router->get('/contact', 'contact.php');

// Notes
$router->get('/notes', 'notes/index.php')->only('auth');
// Note
// View routes
$router->get('/note', 'notes/show.php');
$router->get('/note/create', 'notes/create.php');
$router->get('/note/edit', 'notes/edit.php');
// Interaction routes
$router->post('/note', 'notes/store.php');
$router->patch('/note', 'notes/update.php');
$router->delete('/note', 'notes/destroy.php');

// Auth
$router->get('/register', 'registration/create.php')->only('guest');
$router->post('/register', 'registration/store.php');
$router->get('/login', 'session/create.php')->only('guest');
$router->post('/session', 'session/store.php')->only('guest');
$router->delete('/session', 'session/destroy.php')->only('auth');
