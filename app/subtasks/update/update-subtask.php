<?php

declare(strict_types=1);

require __DIR__ . '/../../autoload.php';

// If user is signed in, show session vairables
if (!isset($_SESSION['user'])) {
    redirect('/signin.php');
}

$id = $_SESSION['task']['id'];

if (isset($_POST['subtask-name'])) {
    $id = $_SESSION['task']['id'];
    $subTaskID = $_POST['subtask-id'];
    $subTaskName = trim($_POST['subtask-name']);

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
