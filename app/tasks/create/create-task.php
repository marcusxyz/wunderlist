<?php

declare(strict_types=1);

require __DIR__ . '/../../autoload.php';

// When submitting, store values tasks tables
if (isset($_POST['task_name'], $_POST['due_date'], $_POST['task_notes'])) {
    $listID = $_SESSION['list']['id']; // How should I do this??
    $taskName = trim($_POST['task_name']);
    $taskNotes = trim($_POST['task_notes']);
    $dueDate = trim($_POST['due_date']);
    $createdDate = date('Y-m-d H:i');

    // Connect users to their tasks by inserting user_id to tasks table.
    $userID = $_SESSION['user']['id'];

    // Insert $userID, $title, $task_notes, $dueDate into tasks table
    $statement = $database->prepare('INSERT INTO tasks (user_id, list_id, task_name, task_notes, due_date, created_date) VALUES(:user_id, :list_id, :task_name, :task_notes, :due_date, :created_date)');
    $statement->bindParam(':user_id', $userID, PDO::PARAM_INT);
    $statement->bindParam(':task_name', $taskName, PDO::PARAM_STR);
    $statement->bindParam(':task_notes', $taskNotes, PDO::PARAM_STR);
    $statement->bindParam(':due_date', $dueDate, PDO::PARAM_STR);
    $statement->bindParam(':created_date', $createdDate, PDO::PARAM_STR);
    $statement->execute();

    $statement = $database->prepare('SELECT * FROM tasks WHERE user_id = :user_id');
    $statement->bindParam(':user_id', $userID, PDO::PARAM_STR);
    $statement->execute();

    $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);

    // print_r($tasks);

    foreach ($tasks as $task) {
        $_SESSION['tasks'] = [
            'id' => $task['id'],
            'task_name' => $task['task_name'],
            'task_notes' => $task['task_notes'],
            'due_date' => $task['due_date'],
            'status' => $task['status'],
        ];
    }


    $_SESSION['message'] = 'Great work! A new task has been added.';
    // Remove to show warnings
    redirect('/');
}
