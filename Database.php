<?php

class Database
{
  public PDO $connection;

  public function __construct()
  {
    $dsn = 'mysql:host=localhost;port=3306;dbname=laracast_php_tut;charset=utf8mb4;';

    $this->connection = new PDO($dsn, 'root', '');
  }

  public function query(string $query)
  {
    $statement = $this->connection->prepare($query);
    $statement->execute();

    return $statement;
  }
}
