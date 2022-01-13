<?php

declare(strict_types=1);

require __DIR__ . '/../../autoload.php';

$id = $_SESSION['user']['id'];
$email = $_SESSION['user']['email'];

// Change email
if (isset($_POST['email'])) {
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    // Check if email exists in database
    $statement = $database->prepare('SELECT * FROM users WHERE email = :email');
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();

    $checkUserEmail = $statement->fetch(PDO::FETCH_ASSOC);

    if ($checkUserEmail !== false) {
        $_SESSION['error'] = 'Seems like this email exist, try signing in!';
        redirect('/profile.php');
    }
    // If everything checks out update value
    $updateEmail = $database->prepare('UPDATE users SET email = :email WHERE id = :id');
    $updateEmail->bindParam(':email', $email, PDO::PARAM_STR);
    $updateEmail->bindPARAM(':id', $id, PDO::PARAM_INT);
    $updateEmail->execute();

    // Updating session variable
    $_SESSION['user']['email'] = $email;
    $_SESSION['message'] = 'Email has been updated';
    redirect('/profile.php');
}
