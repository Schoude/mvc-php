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
          'email' => $email
        ]);

        return true;
      }
    }

    return false;
  }

  public function login(array $user)
  {
    $_SESSION['user'] = [
      'email' => $user['email']
    ];

    // Create as new session id.
    // Any leaked session ids get invalidated.
    session_regenerate_id(true);
  }

  public function logout()
  {
    Session::destroy();
  }
}
