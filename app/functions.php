<?php

declare(strict_types=1);

function redirect(string $path)
{
    header("Location: ${path}");
    exit;
}

function fetchTasks(PDO $database): array
{
    $userID = $_SESSION['user']['id'];
    $status = 0;
    $today = date('D j M Y');

    $statement = $database->query('SELECT * FROM tasks WHERE user_id = :user_id AND due_date != :due_date AND status = :status ORDER BY due_date ASC');
    $statement->bindParam(':user_id', $userID, PDO::PARAM_INT);
    $statement->bindParam(':due_date', $today, PDO::PARAM_STR);
    $statement->bindParam(':status', $status, PDO::PARAM_INT);
    $statement->execute();

    $getTasks = $statement->fetchALL(PDO::FETCH_ASSOC);
    return $getTasks;
}

function editTasks(PDO $database): array
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
        'status' => $getTask['status'],
    ];
    return $getTask;
}

function fetchSubTasks(PDO $database): array
{
    $taskID = $_SESSION['task']['id'];

    $statement = $database->query('SELECT * FROM lists WHERE task_id = :task_id');
    $statement->bindParam(':task_id', $taskID, PDO::PARAM_INT);
    $statement->execute();

    $getSubTasks = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $getSubTasks;
}

function fetchTodaysTasks(PDO $database): array
{
    $userID = $_SESSION['user']['id'];
    $status = 0;
    $today = date('D j M Y');

    $statement = $database->query('SELECT * FROM tasks WHERE user_id = :user_id AND due_date = :due_date AND status = :status');
    $statement->bindParam(':user_id', $userID, PDO::PARAM_INT);
    $statement->bindParam(':status', $status, PDO::PARAM_INT);
    $statement->bindParam(':due_date', $today, PDO::PARAM_STR);
    $statement->execute();

    $getTodaysTasks = $statement->fetchALL(PDO::FETCH_ASSOC);
    return $getTodaysTasks;
}

function taskCompleted(PDO $database): array
{
    $userID = $_SESSION['user']['id'];
    $status = 1;

    $statement = $database->query('SELECT * FROM tasks WHERE user_id = :user_id AND status = :status');
    $statement->bindParam(':user_id', $userID, PDO::PARAM_INT);
    $statement->bindParam(':status', $status, PDO::PARAM_INT);
    $statement->execute();

    $getCompletedTasks = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $getCompletedTasks;
}
