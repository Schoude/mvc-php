<?php

logout();

// Redirect to non-authorized entrypoint
header('Location: /login');
