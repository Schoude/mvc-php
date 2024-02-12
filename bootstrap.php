<?php

use Core\App;
use Core\Container;
use Core\Database;

App::setContainer(new Container());

App::bind('Core\Database', function () {
  $config = require(base_path('config.php'));

  return new Database($config['database']);
});

$loader = new \Twig\Loader\FilesystemLoader(base_path('/views/twig'));
$twig = new \Twig\Environment($loader, [
  'cache' => base_path('/views/twig/cache'),
  'auto_reload' => true,
]);


App::bind('twig', function () use ($twig) {
  return $twig;
});
