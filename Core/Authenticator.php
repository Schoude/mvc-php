<?php

namespace Core;

class Authenticator
{
  public function attemptRegister(string $email, string $password): bool
  {
    /** @var Database $db */
    $db = App::resolve(Database::class);

    $foundUser = $db->query(
      'select * from users where email = :email',
      [
        ':email' => $email,
      ]
    )->find();

    if ($foundUser) {
      return false;
    }

    $db->query(
      'insert into users (email, password) values (:email, :password)',
      [
        ':email' => $email,
        ':password' => password_hash($password, PASSWORD_BCRYPT),
      ]
    )->find();

    $this->login([
      'email' => $email
    ]);

    return true;
  }

  public function attempt(string $email, string $password): bool
  {
    /** @var Database $db */
    $db = App::resolve(Database::class);

    $user = $db->query('select * from users where email = :email', [
      ':email' => $email,
    ])->find();

    if ($user) {
      if (password_verify($password, $user['password'])) {
        $this->login([
          'id' => $user['id'],
          'email' => $email
        ]);

        return true;
      }
    }

    return false;
  }

  public function login(array $user)
  {
    Session::put('user', [
      'id' => $user['id'],
      'email' => $user['email']
    ]);

    session_regenerate_id(true);
  }

  public function logout()
  {
    Session::destroy();
  }

  public function user()
  {
    Session::get('user');
  }
}
