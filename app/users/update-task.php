<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// If user is signed in, show session vairables
if (isset($_SESSION['user'])) {
    $id = $_SESSION['user']['id'];
    $username = $_SESSION['user']['username'];
    $email = $_SESSION['user']['email'];
} else {
    redirect('/signin.php');
}
