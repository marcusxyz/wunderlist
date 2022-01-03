<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

$id = $_SESSION['user']['id'];
$username = $_SESSION['user']['name'];
$email = $_SESSION['user']['email'];

// In here users can delete their account

if (isset($_POST['delete'])) {
    $deleteConfirm = $_POST['delete'];

    if ($deleteConfirm === '') {
        $_SESSION['error'] = "Make sure to enter 'DELETE' and your password to confirm";
        redirect('/delete.php');
    }

    if ($deleteConfirm === 'DELETE') {
        $statement = $database->prepare('SELECT * FROM users WHERE email = :email');
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);
    }

    if (isset($_POST['password'])) {
        $password = $_POST['password'];

        if (password_verify($password, $user['password'])) {
            $_SESSION['message'] = 'WOOH, it works!';

            redirect('/delete.php');
        } else {
            $_SESSION['error'] = 'Your password has been entered incorrectly.';
        }

        redirect('/delete.php');
    }


    redirect('/delete.php');
}
