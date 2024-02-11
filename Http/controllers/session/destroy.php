<?php

use Core\Authenticator;

(new Authenticator)->logout();

// Redirect to non-authorized entrypoint
header('Location: /login');
