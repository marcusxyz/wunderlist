<?php

declare(strict_types=1);

require __DIR__ . '/../../autoload.php';

// If user is signed in, show session vairables
if (!isset($_SESSION['user'])) {
    redirect('/signin.php');
}

//If users adds subtasks
if (isset($_POST['subtask_name'], $_POST['status'])) {
    $id = $_SESSION['task']['id'];

    $subtaskName = trim($_POST['subtask_name']);
    $status = trim($_POST['status']);
    $statement = $database->prepare('INSERT INTO lists (task_id, subtask_name, status) VALUES(:task_id, :subtask_name, :status)');
    $statement->bindParam(':task_id', $id, PDO::PARAM_INT);
    $statement->bindParam(':subtask_name', $subtaskName, PDO::PARAM_STR);
    $statement->bindParam(':status', $status, PDO::PARAM_INT);
    $statement->execute();

    $statement = $database->query('SELECT * FROM lists WHERE task_id = :task_id');
    $statement->bindParam(':task_id', $taskID, PDO::PARAM_INT);
    $statement->execute();

    $getSubTasks = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach (fetchSubTasks($database) as $subTask) {
        $_SESSION['subtask'] = [
            'id' => $subTask['id'],
            'subtask_name' => $subTask['subtask_name'],
            'status' => $subTask['status'],
        ];
    }

    redirect("/edit-task.php?id=$id");
}

redirect("/edit-task.php?id=$id");
