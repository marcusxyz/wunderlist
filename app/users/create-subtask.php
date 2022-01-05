<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// If user is signed in, show session vairables
if (!isset($_SESSION['user'])) {
    redirect('/signin.php');
}

if (isset($_POST['subtask_name'])) {
    echo 'It works';
    $_SESSION['message'] = 'Subtask added';
    redirect("/edit-task.php?id=$id.php");
}
