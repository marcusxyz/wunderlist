<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// If user is signed in, show session vairables
if (!isset($_SESSION['user'])) {
    redirect('/signin.php');
}

echo '<pre>';
var_dump($_POST);
echo '</pre>';

if (isset($_POST['subtask-status'])) {
    echo 'It works';
} else {
    echo 'Something went wrong';
}
