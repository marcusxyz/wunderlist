<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// If user is signed in, show session vairables
if (isset($_SESSION['user'])) {
    $id = $_SESSION['task']['id'];
    $taskName = $_POST['task_name'];
    $dueDate = $_POST['due_date'];
    $taskNotes = $_POST['task_notes'];
    $_POST['task_name'] = $_SESSION['task']['task_name'];
    $_POST['due_date'] = $_SESSION['task']['due_date'];
    $_POST['task_notes'] = $_SESSION['task']['task_notes'];

    // echo $_POST['task_name'];
    // echo $_POST['due_date'];
    // echo $_POST['task_notes'];

} else {
    redirect('/signin.php');
}


// If fields are unchanged while saving, display error message.
if ($taskName === $_POST['task_name'] && $dueDate == $_POST['due_date'] && $taskNotes === $_POST['task_notes']) {
    $_SESSION['error'] = 'No changes has been made';
    // echo 'No changes has been made';
    redirect("/edit-task.php?id=$id.php");
} else {
    $_SESSION['error'] = 'Something is went wrong with validation';
    // echo 'Something is went wrong with validation';
    // echo $taskName;
    // echo $_POST['task_name'];
    redirect("/edit-task.php?id=$id.php");
}

// print_r($_SESSION['task']['id']);

// redirect("/edit-task.php?id=$id");
