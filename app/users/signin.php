<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// Check if email and password exist in the POST request.

if (isset($_POST['email'], $_POST['password'])) {
    // Sanitize email
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $password = $_POST['password'];

    $statement = $database->prepare('SELECT * FROM users WHERE email = :email');
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // If user is found, compare given password to password in db with password_verify
    if (password_verify($_POST['password'], $user['password'])) {
        // If password checks out save the user in session. Don't save password in session.
        unset($user['password']);

        $_SESSION['user'] = $user;
        $_SESSION['message'] = 'Welcome ' . $user['name'] . ', here\'s your tasks.';
    }
    header('Location: /index.php');
}
