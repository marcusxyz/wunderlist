<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we logout users.
session_start();

if (isset($_SESSION['user'])) {
    unset($_SESSION['user']);
}

header('Location: /index.php');
