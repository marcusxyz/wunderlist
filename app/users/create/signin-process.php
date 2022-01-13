<?php

declare(strict_types=1);

require __DIR__ . '/../../autoload.php';

// Check if email and password exist in the POST request.

if (isset($_POST['email'], $_POST['password'])) {
    // Sanitize email
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $password = $_POST['password'];

    $statement = $database->prepare('SELECT * FROM users WHERE email = :email');
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // Check if user exist, otherwise provide a sign up message
    if ($user === false) {
        $_SESSION['error'] = 'The email does not exist, try signing up!';
        redirect('/signin.php');
    }

    // Password errors
    // If user is found, compare given password to password in db with password_verify
    if (password_verify($password, $user['password'])) {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email'],
            'avatar' => $user['avatar'],
        ];
        // unset($user['password']); This also hides other session values on refresh..

        $_SESSION['message'] = 'Welcome ' . $user['username'] . '!';
        redirect('/');
    } else {
        $_SESSION['error'] = 'The provided credentials does not match our records.';
        redirect('/signin.php');
    }
}
