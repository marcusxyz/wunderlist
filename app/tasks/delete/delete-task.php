<?php

declare(strict_types=1);

require __DIR__ . '/../../autoload.php';

// If user is signed in, show session vairables
if (!isset($_SESSION['user'])) {
    redirect('/signin.php');
}

// In here users can delete tasks along with their subtasks

$taskID = $_SESSION['task']['id'];

// First we delete all subtasks that belongs to the task
$statement = $database->prepare('DELETE from lists WHERE task_id = :task_id');
$statement->bindParam(':task_id', $taskID, PDO::PARAM_INT);
$statement->execute();

// Once all subtask is gone, delete the task.
$statement = $database->prepare('DELETE from tasks WHERE id  = :id');
$statement->bindParam(':id', $taskID, PDO::PARAM_INT);
$statement->execute();

$_SESSION['message'] = 'Task has been deleted';
redirect('/');
