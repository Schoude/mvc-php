<?php

class Database
{
  public PDO $connection;

  public function __construct(array $config, string $username = 'root', string $password = '')
  {
    $dbQuery = http_build_query($config, '', ';');

    $dsn = "mysql:$dbQuery";

    $this->connection = new PDO($dsn, $username, $password, [
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
  }

  public function query(string $query): PDOStatement|false
  {
    $statement = $this->connection->prepare($query);
    $statement->execute();

    return $statement;
  }
}
