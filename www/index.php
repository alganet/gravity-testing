<?php

/**
 * Supercluster Web Application
 *
 * Outputs the application to the web
 *
 * @see supercluster.ini
 * @see boot.php
 */

print call_user_func(include realpath(__DIR__ . '/../boot.php'));
