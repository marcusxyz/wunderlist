<?php

declare(strict_types=1);

// Start the session engines.
session_start();

// Set timezone
date_default_timezone_set('UTC');

// Set default character encoding
mb_internal_encoding('UTF-8');

// Include helper functions
require __DIR__ . '/functions.php';

// Fetch the global configuration array
$config = require __DIR__ . '/config.php';

// Setup the database connection
$database = new PDO($config['database_path']);
