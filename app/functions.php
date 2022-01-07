<?php

declare(strict_types=1);

// Can't get this to work
function redirect(string $path)
{
    header("Location: ${path}");
    exit;
}

function fetchTasks($database): array
{
    $userID = $_SESSION['user']['id'];

    $statement = $database->prepare('SELECT * FROM tasks WHERE user_id = :user_id');
    $statement->bindParam(':user_id', $userID, PDO::PARAM_INT);
    $statement->execute();

    $getTasks = $statement->fetchALL(PDO::FETCH_ASSOC);
    return $getTasks;
}

function editTasks($database)
{
    $taskID = $_SESSION['taskID'];
    $statement = $database->prepare('SELECT * FROM tasks WHERE id = :id');
    $statement->bindParam(':id', $taskID, PDO::PARAM_INT);
    $statement->execute();

    $getTask = $statement->fetch(PDO::FETCH_ASSOC);

    $_SESSION['task'] = [
        'id' => $getTask['id'],
        'task_name' => $getTask['task_name'],
        'due_date' => $getTask['due_date'],
        'task_notes' => $getTask['task_notes'],
    ];
    return $getTask;
}

function fetchSubTasks($database): array
{
    $taskID = $_SESSION['task']['id'];

    $statement = $database->query('SELECT * FROM lists WHERE task_id = :task_id');
    $statement->bindParam(':task_id', $taskID, PDO::PARAM_INT);
    $statement->execute();

    $getSubTasks = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $getSubTasks;
}
