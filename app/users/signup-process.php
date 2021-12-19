<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['submit-signup'])) {
    $username = trim(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $passphrase = $_POST['password'];
    $confirmPassphrase = $_POST['password-confirm'];

    // Validate passphrase requirements
    if (!preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#", $passphrase)) {
        $_SESSION['error'] = 'Password did not meet requirements below';
        redirect('/signup.php');
        die();
    }

    // Check if password matches before adding
    if ($passphrase !== $confirmPassphrase) {
        $_SESSION['error'] = 'Your password doesn\'t match, please try again';
        redirect('/signup.php');
        die();
    } else {
        $password = password_hash($passphrase, PASSWORD_DEFAULT);
    }

    $statement = $database->prepare('SELECT * FROM users WHERE email = :email');
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // Check if user exists in database
    if ($user !== false) {
        $_SESSION['error'] = 'Seems like the email exist, try signing in!';
        redirect('/signup.php');
        die();
    }

    $statement = $database->prepare('INSERT INTO users(name, email, password) VALUES(:name, :email, :password)');

    $statement->bindParam(':name', $username, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':password', $password, PDO::PARAM_STR);

    $statement->execute();

    echo 'Account created!';
    // redirect('/signin.php');
}
redirect('/signin.php');
