<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

echo 'woho';

// Remove the user session variable and redirect the user back to the homepage.
session_destroy();

redirect('/');