<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// When submitting, store values into lists and tasks tables
if (isset($_POST['title'], $_POST['due_date'], $_POST['task_notes'])) {
    // echo 'Inserting to db';
    $title = trim($_POST['title']);
    $dueDate = trim($_POST['due_date']);
    $taskNotes = trim($_POST['task_notes']);

    // Connect users to their tasks by inserting user_id to lists table.
    $userID = $_SESSION['user']['id'];

    // Insert $userID, $title, $task_notes, $dueDate into lists table
    $statement = $database->prepare('INSERT INTO lists(user_id, title, due_date, task_notes) VALUES(:user_id, :title, :due_date, :task_notes)');
    $statement->bindParam(':user_id', $userID, PDO::PARAM_INT);
    $statement->bindParam(':title', $title, PDO::PARAM_STR);
    $statement->bindParam(':due_date', $dueDate, PDO::PARAM_INT);
    $statement->bindParam(':task_notes', $taskNotes, PDO::PARAM_STR);
    $statement->execute();

    $statement = $database->prepare('SELECT * FROM lists WHERE id = :id');
    $statement->bindParam(':id', $listId, PDO::PARAM_STR);
    $statement->execute();

    $list = $statement->fetch(PDO::FETCH_ASSOC);

    $_SESSION['list'] = [
        'id' => $list['id'],
        'title' => $list['title'],
        'due_date' => $list['due_date'],
        'task_notes' => $list['task_notes'],
    ];

    $listID = $_SESSION['list']['id'];

    // Insert $title, $dueDate and $taskNotes into tasks table
    $statement = $database->prepare('INSERT INTO tasks(list_id, title, due_date, task_notes) VALUES(:list_id, :title, :due_date, :task_notes)');
    $statement->bindParam(':list_id', $listID, PDO::PARAM_STR);
    $statement->bindParam(':title', $title, PDO::PARAM_STR);
    $statement->bindParam(':due_date', $dueDate, PDO::PARAM_INT);
    $statement->bindParam(':task_notes', $taskNotes, PDO::PARAM_STR);
    $statement->execute();

    $_SESSION['message'] = 'Great work! A new task has been added.';
    // Remove to show warnings
    // redirect('/');
} else {
    echo 'It\'s not working! :(';

    redirect('/new-task.php');
}

// redirect('/');
