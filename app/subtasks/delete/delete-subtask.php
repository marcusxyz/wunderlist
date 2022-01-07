<?php

declare(strict_types=1);

require __DIR__ . '/../../autoload.php';

// If user is signed in, show session vairables
if (!isset($_SESSION['user'])) {
    redirect('/signin.php');
}
// In here users can delete their subtasks
$id = $_SESSION['task']['id'];

$subTaskID = $_GET['id'];
$subTaskName = $_GET['name'];

$statement = $database->prepare('DELETE FROM lists WHERE subtask_name = :subtask_name AND id = :id');
$statement->bindParam(':id', $subTaskID, PDO::PARAM_INT);
$statement->bindParam(':subtask_name', $subTaskName, PDO::PARAM_STR);
$statement->execute();

redirect("/edit-task.php?id=$id");
