<?php

use Core\App;
use Core\Container;
use Core\Database;

App::setContainer(new Container());

App::bind('Core\Database', function () {
  $config = require(base_path('config.php'));

  return new Database($config['database']);
});
