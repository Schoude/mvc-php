<?php

namespace Core;

class Authenticator
{
  public function attempt(string $email, string $password): bool
  {
    /** @var Database $db */
    $db = App::resolve(Database::class);

    $user = $db->query('select * from users where email = :email', [
      ':email' => $email,
    ])->find();

    if ($user) { // Email is correct
      // 2) Compare the passwords
      if (password_verify($password, $user['password'])) {
        // Password is correct, so login the user and redirect to home.
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

    // Create as new session id.
    // Any leaked session ids get invalidated.
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
