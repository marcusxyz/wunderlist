<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

//In this file we want to update user settings

// Username
if (isset($_SESSION['user'])) {

    // print_r($_SESSION['user']);

    if (isset($_POST['name'])) {
        $username = trim($_POST['name']);

        // Check username requirements
        if (!ctype_alnum($username)) {
            $_SESSION['error'] = 'Username should only contain letters and numbers';
            redirect('/signup.php');
        }
    }
}

// Fetch Username and add it to input value


//Email
// Fetch Email and add it to input value

$statement = $database->prepare("SELECT * FROM users WHERE name = $user");
$statement->execute();

$username = $statement->fetchAll(PDO::FETCH_ASSOC);

echo $_SESSION['user'];
var_dump($_SESSION);

die(var_dump($username));

// $_SESSION['user'] = [
//     'id' => $user['id'],
// ];

//Password
    // Check if old password is correct

    // Compare new password with confirm password, if its true update password in database.
