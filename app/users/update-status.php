<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// If user is signed in, show session vairables
if (!isset($_SESSION['user'])) {
    redirect('/signin.php');
}

// echo '<pre>';
// var_dump($_POST);
// // print_r($_POST['subtask-id']);
// echo '</pre>';

// echo '<pre>';
// var_dump($_SESSION['subtask']);
// echo '</pre>';
$id = $_SESSION['task']['id'];

print_r($_SESSION['task']);


if (isset($_POST['subtask-id'], $_POST['subtask-name'], $_POST['subtask-status'])) {

    $subTaskID = $_POST['subtask-id'];
    $taskID = $_POST['id'];
    $subTaskName = $_POST['subtask-name'];
    $status = $_POST['subtask-status'];

    // When checkbox is checked change status to 1 and update db
    if (isset($_POST['checkbox-toggle'])) {
        // 1 = subtask is completed
        $status = 1;
        echo $status;
        echo 'It is checked';

        $statement = $database->prepare('UPDATE lists SET status = :status WHERE id = :id');
        $statement->bindParam(':id', $subTaskID, PDO::PARAM_INT);
        $statement->bindParam(':status', $status, PDO::PARAM_INT);
        $statement->execute();
        redirect("/edit-task.php?id=$id");
    }

    // When checkbox is unchecked change status to 0 and update db.
    if (!isset($_POST['checkbox-toggle'])) {
        // 0 = subtask is uncompleted
        $status = 0;
        echo $status;
        echo 'It is unchecked';

        $statement = $database->prepare('UPDATE lists SET status = :status WHERE id = :id');
        $statement->bindParam(':id', $subTaskID, PDO::PARAM_INT);
        $statement->bindParam(':status', $status, PDO::PARAM_INT);
        $statement->execute();
        redirect("/edit-task.php?id=$id");
    }
    redirect("/edit-task.php?id=$id");
}
