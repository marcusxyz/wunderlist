<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

//In this file we want to sign out users

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

if (isset($_SESSION['user'])) {
    unset($_SESSION['user']);

    $_SESSION['message'] = 'You\'ve successfully signed out.';
    redirect('/signin.php');
}
