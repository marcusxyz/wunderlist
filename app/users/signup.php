<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// Start the session
session_start();

if (isset($_POST['name'], $_POST['email'], $_POST['password'], $_POST['password-confirm'])) {
    // $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    // $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    echo 'It works';
} else {
    echo 'It does not work';
}

header('Location: /signup.php');
// redirect('/login.php');
