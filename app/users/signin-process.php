<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

$error = [];

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
        // If password checks out save the user in session. Don't save password in session.
        $_SESSION['user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
        ];
        unset($user['password']);

        $_SESSION['message'] = 'Welcome ' . $user['name'] . ', here\'s your tasks.';
        redirect('/');
    } else {
        $_SESSION['error'] = 'The provided credentials does not match our records.';
        redirect('/signin.php');
    }
}