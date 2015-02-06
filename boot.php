<?php

/**
 * Supercluster Bootstrap File
 *
 * Loads a sandboxed application using a sandboxed container.
 *
 * @see supercluster.ini
 * @see www/index.php
 */

use Supercluster\Gravity\Boot;

require 'vendor/autoload.php';

// All application boostrapped files run on main root app folder
chdir(__DIR__);

return new Boot(
    filter_var(getenv('SUPERCLUSTER_ENV'), FILTER_SANITIZE_STRING)
);
