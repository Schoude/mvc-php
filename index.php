<?php

require './functions.php';

// require './router.php';

require './Database.php';

$db = new Database();

// PDO::FETCH_ASSOC returns only the associative array values ('id' => 1, 'name' => 'Test')
// and not the indexed ([0] => 1, [1] => 'Test') values
$posts = $db->query('select * from posts')->fetchAll(PDO::FETCH_ASSOC);

foreach ($posts as $post) {
  echo "<li>{$post['title']}</li>";
}
