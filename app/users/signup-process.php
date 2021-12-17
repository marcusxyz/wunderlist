<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['submit-signup'])) {
    // echo 'WOOOH! It works';
    $_SESSION['error-message'] = 'Hello';
    $name = (filter_var($_POST['name'], FILTER_SANITIZE_STRING));
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $confirmPassword = password_hash($_POST['password-confirm'], PASSWORD_DEFAULT);

    // Error handlers
    // We check if the inputed value is empty or not.
    if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
        $_SESSION['error'] = 'Please fill in missing fields';
        // echo 'Please fill in missing fields';
        redirect('/signup.php');
        exit();
    }

    // Check if mail exists in database
    // if ($_POST['email'] === $user['email']) {
    // }

    // Check if password matches before adding
    if ($password !== $confirmPassword) {
        $_SESSION['error'] = 'Your password doesn\'t match, please try again';
        redirect('/signup.php');
        exit();
    } else {
        // Insert password to database.
    }
} else {
    // echo 'Why is it not working?? :(';
}
