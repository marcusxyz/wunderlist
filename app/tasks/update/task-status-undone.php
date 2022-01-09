<?php

declare(strict_types=1);

require __DIR__ . '/../../autoload.php';

// If user is signed in, show session vairables
if (!isset($_SESSION['user'])) {
    redirect('/signin.php');
}

// When users marks task as undone
$id = $_SESSION['task']['id'];
$status = 0;

$statement = $database->prepare('UPDATE tasks SET status = :status WHERE id = :id');
$statement->bindParam(':id', $id, PDO::PARAM_INT);
$statement->bindParam('status', $status, PDO::PARAM_INT);
$statement->execute();

// Unmark aswell all subtasks, if user hasn't marked them
$statement = $database->prepare('UPDATE lists SET status = :status WHERE task_id = :task_id');
$statement->bindParam(':task_id', $id, PDO::PARAM_INT);
$statement->bindParam(':status', $status, PDO::PARAM_INT);
$statement->execute();

$_SESSION['message'] = 'Task marked as undone';

redirect("/edit-task.php?id=$id");
