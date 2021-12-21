<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['name'], $_POST['email'], $_POST['password'], $_POST['password-confirm'])) {
    $username = trim($_POST['name']); // FILTER_SANITIZE_STRING is deprecated.
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $passphrase = $_POST['password'];
    $confirmPassphrase = $_POST['password-confirm'];

    // Validate passphrase requirements
    if (strlen($passphrase) < 8) {
        $_SESSION['error'] = 'Password needs to be atleast 8 characters or longer';
        redirect('/signup.php');
    }

    // Check if password matches before adding
    if ($passphrase !== $confirmPassphrase) {
        $_SESSION['error'] = 'Your password doesn\'t match, please try again';
        redirect('/signup.php');
    } else {
        $password = password_hash($passphrase, PASSWORD_DEFAULT);
    }

    // Check username requirements (Only letters and numbers allowed)
    if (!ctype_alnum($username)) {
        $_SESSION['error'] = 'Username should only contain letters and numbers. No spaces allowed.';
        redirect('/signup.php');
    }

    // Check if email exists in database
    $statement = $database->prepare('SELECT * FROM users WHERE email = :email');
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();

    $checkUserEmail = $statement->fetch(PDO::FETCH_ASSOC);

    if ($checkUserEmail !== false) {
        $_SESSION['error'] = 'Seems like this email exist, try signing in!';
        redirect('/signup.php');
    }

    // Check if username exists in database
    $statement = $database->prepare('SELECT * FROM users WHERE name = :name');
    $statement->bindParam(':name', $username, PDO::PARAM_STR);
    $statement->execute();

    $checkUsername = $statement->fetch(PDO::FETCH_ASSOC);

    if ($checkUsername !== false) {
        $_SESSION['error'] = 'This username is in use, please try a different name.';
        redirect('/signup.php');
    }

    // Reg users to db and send them to sign in page.
    $statement = $database->prepare('INSERT INTO users(name, email, password) VALUES(:name, :email, :password)');

    $statement->bindParam(':name', $username, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':password', $password, PDO::PARAM_STR);

    $statement->execute();

    $_SESSION['message'] = 'Your account has been created! Please sign in below.';
    redirect('/signin.php');
}
redirect('/signup.php');
