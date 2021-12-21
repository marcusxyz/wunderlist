<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// When submitting, store values into lists and tasks tables
if (isset($_POST['title'], $_POST['due_date'], $_POST['task_notes'])) {
    echo 'Inserting to db';
    $title = htmlspecialchars($_POST['title']);
    $dueDate = $_POST['due_date'];
    $taskNotes = htmlspecialchars($_POST['task_notes']);

    $userID = $_SESSION['user']['id'];

    // Insert user_id to tasks table
    $statement = $database->prepare('INSERT INTO lists(user_id) VALUES(:user_id)');
    $statement->bindParam(':user_id', $userID, PDO::PARAM_STR);
    $statement->execute();

    $_SESSION['message'] = 'UserID added to lists';
    redirect('/');
} else {
    echo 'It\'s not working! :(';
    redirect('/new-task.php');
}

redirect('/');
