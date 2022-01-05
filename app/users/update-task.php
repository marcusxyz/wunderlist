<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// If user is signed in, show session vairables
if (!isset($_SESSION['user'])) {
    redirect('/signin.php');
}

if (isset($_POST['task_name'], $_POST['due_date'], $_POST['task_notes'], $_POST['subtask_name'])) {
    $id = $_SESSION['task']['id'];
    $taskName = trim($_POST['task_name']);
    $dueDate = trim($_POST['due_date']);
    $taskNotes = trim($_POST['task_notes']);
    $_POST['task_name'] = $_SESSION['task']['task_name'];
    $_POST['due_date'] = $_SESSION['task']['due_date'];
    $_POST['task_notes'] = $_SESSION['task']['task_notes'];

    // If fields are unchanged while saving, display error message.
    if ($taskName === $_POST['task_name'] && $dueDate === $_POST['due_date'] && $taskNotes === $_POST['task_notes'] && $_POST['subtask_name'] === '') {
        $_SESSION['error'] = 'No changes has been made';
        // echo 'No changes has been made';
        redirect("/edit-task.php?id=$id.php");
    }

    // If any of the fields has been changed, update the values in db
    if ($taskName !== $_POST['task_name'] || $dueDate !== $_POST['due_date'] || $taskNotes !== $_POST['task_notes']) {
        $statement = $database->prepare('UPDATE tasks SET task_name = :task_name, due_date = :due_date, task_notes = :task_notes WHERE id = :id');
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->bindParam(':task_name', $taskName, PDO::PARAM_STR);
        $statement->bindParam(':due_date', $dueDate, PDO::PARAM_STR);
        $statement->bindParam(':task_notes', $taskNotes, PDO::PARAM_STR);
        $statement->execute();

        $_SESSION['message'] = 'Your task has been updated';
        redirect("/edit-task.php?id=$id");
    }
}

//If users adds subtasks
if (isset($_POST['subtask_name'])) {
    $subtaskName = trim($_POST['subtask_name']);
    $statement = $database->prepare('INSERT INTO lists (task_id, subtask_name) VALUES(:task_id, :subtask_name)');
    $statement->bindParam(':task_id', $id, PDO::PARAM_INT);
    $statement->bindParam(':subtask_name', $subtaskName, PDO::PARAM_STR);
    $statement->execute();

    $_SESSION['message'] = 'Subtask added.';
    redirect("/edit-task.php?id=$id");
}

// Checkbox

// if (isset($_POST['status'])) {
//     $_SESSION['message'] = 'checked';
// } else {
//     $_SESSION['message'] = 'unchecked';
// };

// $status = $_POST['status'];
// if ($status == 1) {
//     $status = 1;
//     $_SESSION['message'] = 'Checked!';
//     redirect("/edit-task.php?id=$id");
// } else {
//     $status = 0;
//     $_SESSION['error'] = 'Unchecked';
//     redirect("/edit-task.php?id=$id");
// }
redirect("/edit-task.php?id=$id");
