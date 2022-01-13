<?php

declare(strict_types=1);

require __DIR__ . '/../../autoload.php';

// If user is signed in, show session vairables
if (isset($_SESSION['user'])) {
    $id = $_SESSION['user']['id'];
    $username = $_SESSION['user']['username'];
    $email = $_SESSION['user']['email'];
} else {
    redirect('/signin.php');
}

// If fields are unchanged while saving, display error message.
if ($username === $_POST['username'] && $email === $_POST['email'] && empty($_POST['password']) && empty($_POST['password-new']) && empty($_POST['password-confirm'])) {
    $_SESSION['error'] = 'No changes has been made';
    redirect('/profile.php');
}

// Check if the user has entered a different username
if ($username !== $_POST['username']) {
    // Change username
    if (isset($_POST['username'])) {
        $username = trim($_POST['username']); // FILTER_SANITIZE_STRING is deprecated.

        // Check if username exists in database
        $statement = $database->prepare('SELECT * FROM users WHERE username = :username');
        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $statement->execute();

        $checkUsername = $statement->fetch(PDO::FETCH_ASSOC);

        if ($checkUsername !== false) {
            $_SESSION['error'] = 'This username has already been taken, please try a different name.';
            redirect('/profile.php');
        }

        // Check username requirements (Only letters and numbers allowed)
        if (!ctype_alnum($username)) {
            $_SESSION['error'] = 'Username should only contain letters and numbers. No spaces allowed.';
            redirect('/profile.php');
        }
        // If everything checks out update value
        $statement = $database->prepare('UPDATE users SET username = :username WHERE id = :id');
        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        // Updating session variable
        $_SESSION['user']['username'] = $username;
        $_SESSION['message'] = 'Your username has been updated';
        redirect('/profile.php');
    }
}

// Check if the user has entered a different email
if ($email !== $_POST['email']) {
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
        $statement = $database->prepare('UPDATE users SET email = :email WHERE id = :id');
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindPARAM(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        // Updating session variable
        $_SESSION['user']['email'] = $email;
        $_SESSION['message'] = 'Your email has been updated';
        redirect('/profile.php');
    }
}

if ($username === $_POST['username'] && $email === $_POST['email'] && !empty($_POST['password'])) {
    // Change password
    if (isset($_POST['password'])) {
        $password = $_POST['password'];

        $statement = $database->prepare('SELECT * FROM users WHERE email = :email');
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        // Compare given password to password in db with password_verify
        if (password_verify($password, $user['password'])) {
            $newPassphrase = $_POST['password-new'];
            $confirmPassphrase = $_POST['password-confirm'];

            // Make sure new password input is not empty
            if (empty($newPassphrase) && empty($confirmPassphrase)) {
                $_SESSION['error'] = 'New password cannot be empty.';
                redirect('/profile.php');
            }

            // Validate passphrase requirements
            if (strlen($newPassphrase) < 8) {
                $_SESSION['error'] = 'Your new password needs to be atleast 8 characters or longer';
                redirect('/profile.php');
            }

            // Check if password matches, if true hash it
            if ($newPassphrase !== $confirmPassphrase) {
                $_SESSION['error'] = 'Your password doesn\'t match, please try again';
                redirect('/profile.php');
            } else {
                $password = password_hash($newPassphrase, PASSWORD_DEFAULT);

                $statement = $database->prepare('UPDATE users SET password = :password WHERE id = :id');
                $statement->bindParam(':password', $password, PDO::PARAM_STR);
                $statement->bindParam(':id', $id, PDO::PARAM_INT);
                $statement->execute();

                $_SESSION['message'] = 'Your password has been updated';
                redirect('/profile.php');
            }
            // $_SESSION['message'] = 'Your old password is correct';
            // redirect('/profile.php');
        } else {
            $_SESSION['error'] = 'Your old password has been entered incorrectly.';
            redirect('/profile.php');
        }
        redirect('/profile.php');
    }
    redirect('/profile.php');
}
redirect('/profile.php');
