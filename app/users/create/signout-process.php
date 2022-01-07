<?php

declare(strict_types=1);

require __DIR__ . '/../../autoload.php';
require __DIR__ . '/../../../general/notifications.php';

//In this file we want to sign out users

if (isset($_SESSION['user'])) {
    unset($_SESSION['user']);

    $_SESSION['message'] = 'You\'ve successfully signed out.';
    redirect('/signin.php');
}
