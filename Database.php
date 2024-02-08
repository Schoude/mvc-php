<?php

class Database
{
  public PDO $connection;

  public function __construct(array $config, string $username = 'root', string $password = '')
  {
    $dbQuery = http_build_query($config, '', ';');

    $dsn = "mysql:$dbQuery";

    // PDO::FETCH_ASSOC returns only the associative array values ('id' => 1, 'name' => 'Test')
    // and not the indexed ([0] => 1, [1] => 'Test') values
    $this->connection = new PDO($dsn, $username, $password, [
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
  }

  public function query(string $query, ?array $params = null): PDOStatement|false
  {
    $statement = $this->connection->prepare($query);
    $statement->execute($params);

    return $statement;
  }
}
