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



// // Change password
// if (isset($_POST['password'], $_POST['password-new'], $_POST['password-confirm'])) {
//     $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
//     $oldPassphrase = $_POST['password'];
//     $newPassphrase = $_POST['password-new'];
//     $confirmPassphrase = $_POST['password-confirm'];

//     $statement = $database->prepare('SELECT password FROM users');
//     $statement->execute();

//     $user = $statement->fetch(PDO::FETCH_ASSOC);

//     // Verify password before applying for a new password
//     if (password_verify($oldPassphrase, $user['password'])) {
//         // Validate passphrase requirements
//         if (strlen($newPassphrase) < 8) {
//             $_SESSION['error'] = 'Your new password needs to be atleast 8 characters or longer';
//             redirect('/profile.php');
//         }
//         // Check if password matches, if true hash it
//         if ($newPassphrase !== $confirmPassphrase) {
//             $_SESSION['error'] = 'Your password doesn\'t match, please try again';
//             redirect('/profile.php');
//         } else {
//             $password = password_hash($newPassphrase, PASSWORD_DEFAULT);
//             $_SESSION['message'] = 'Your password has been updated';
//             redirect('/profile.php');
//         }
//         $_SESSION['error'] = 'Your old password has been entered incorrectly. Please enter it again.';
//         redirect('/profile.php');
//     }

//     // If everything checks out update value
// }
// redirect('/profile.php');
