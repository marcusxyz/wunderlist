<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['submit-signup'])) {
    // echo 'WOOOH! It works';
    $name = (filter_var($_POST['name'], FILTER_SANITIZE_STRING));
    $email = trim($_POST['email']);
    $passphrase = $_POST['password'];
    $confirmPassphrase = $_POST['password-confirm'];

    $statement = $database->prepare('SELECT * FROM users WHERE email = :email');
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // Error handlers
    // We check if the inputed value is empty or not.
    if (empty($name) || empty($email) || empty($passphrase) || empty($confirmPassphrase)) {
        $_SESSION['error'] = 'Please fill in missing fields';
        // echo 'Please fill in missing fields';
        redirect('/signup.php');
    }

    // Check if user exists in database
    if ($user !== false) {
        $_SESSION['error'] = 'Seems like the email exist, try signing in!';
        redirect('/signin.php');
    }

    // Validate passphrase requirements
    if (!preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#", $passphrase)) {
        $_SESSION['error'] = 'Password did not meet requirements below';
    } else {
        // Check if password matches before adding
        if ($passphrase === $confirmPassphrase) {
            // If password matches, hash it and insert into db.
            $_SESSION['error'] = 'Password matches! Insert into db';
            redirect('/signup.php');
        } else {
            $_SESSION['error'] = 'Your password doesn\'t match, please try again';
            redirect('/signup.php');
            die();
        }
    }
}
redirect('/signup.php');
