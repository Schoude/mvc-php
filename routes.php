<?php

$router->get('/', 'index.php');
$router->get('/t', 'twig.php');
$router->get('/t/register', 'twig-register.php');
$router->get('/about', 'about.php');
$router->get('/contact', 'contact.php');

// Notes
$router->get('/notes', 'notes/index.php')->only('auth');
// Note
// View routes
$router->get('/note', 'notes/show.php')->only('auth');
$router->get('/note/create', 'notes/create.php')->only('auth');
$router->get('/note/edit', 'notes/edit.php')->only('auth');
// Interaction routes
$router->post('/note', 'notes/store.php')->only('auth');
$router->patch('/note', 'notes/update.php')->only('auth');
$router->delete('/note', 'notes/destroy.php')->only('auth');

// Auth
// Register
$router->get('/register', 'registration/create.php')->only('guest');
$router->post('/register', 'registration/store.php')->only('guest');
// Login
$router->get('/login', 'session/create.php')->only('guest');
$router->post('/session', 'session/store.php')->only('guest');
// Logout
$router->delete('/session', 'session/destroy.php')->only('auth');
