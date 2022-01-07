<?php

declare(strict_types=1);

require __DIR__ . '/../../autoload.php';

// If user is signed in, show session vairables
if (!isset($_SESSION['user'])) {
    redirect('/signin.php');
}

print_r($_POST);
// print_r($_SESSION['task']);
$id = $_SESSION['task']['id'];

if (isset($_POST['subtask-name'])) {
    $id = $_SESSION['task']['id'];
    $subTaskID = $_POST['subtask-id'];
    $subTaskName = trim($_POST['subtask-name']);

    // If fields are unchanged while saving, display error message.
    // if ($subTaskName !== $_POST['subtask-name']) {
    //     $_SESSION['error'] = 'No changes has been made';
    //     redirect("/edit-subtask.php?id=$subTaskID&name=$subTaskName");
    // }

    $statement = $database->prepare('UPDATE lists SET subtask_name = :subtask_name WHERE id = :id');
    $statement->bindParam(':id', $subTaskID, PDO::PARAM_INT);
    $statement->bindParam(':subtask_name', $subTaskName, PDO::PARAM_STR);
    $statement->execute();

    $_SESSION['message'] = 'Subtask name has been updated';
    redirect("/edit-task.php?id=$id");
} else {
    $_SESSION['error'] = 'Something went wrong';
    redirect("/edit-subtask.php?id=$subTaskID&name=$subTaskName");
}
