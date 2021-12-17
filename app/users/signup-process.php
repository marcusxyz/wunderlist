<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['submit'])) {
    // echo 'WOOOH! It works';

    $name = (filter_var($_POST['name'], FILTER_SANITIZE_STRING));
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $confirmPassword = password_hash($_POST['password-confirm'], PASSWORD_DEFAULT);

    // Error handlers
    // We check if the inputed value is empty or not.
    if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
        $_SESSION['error-message'] = 'Please fill in missing fields';
    }
    redirect('/');
}

redirect('/signup.php');
