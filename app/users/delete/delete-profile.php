<?php

declare(strict_types=1);

require __DIR__ . '/../../autoload.php';

// If user is signed in, show session vairables
if (isset($_SESSION['user'])) {
    $id = $_SESSION['user']['id'];
    $username = $_SESSION['user']['username'];
    $email = $_SESSION['user']['email'];
} else {
    redirect('/signin.php');
}

// In here users can delete their account
if (isset($_POST['delete'])) {
    $deleteConfirm = $_POST['delete'];

    // If field is empty throw out an error
    if ($deleteConfirm === '') {
        $_SESSION['error'] = "Make sure to enter 'DELETE' and your password to confirm";
        redirect('/delete.php');
    }

    if ($deleteConfirm === 'DELETE') {
        $statement = $database->prepare('SELECT * FROM users WHERE email = :email');
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);
    }

    if (isset($_POST['password'])) {
        $password = $_POST['password'];

        // Make sure to remove tasks and subtasks related to user before deleting account.
        $taskID = $_SESSION['task']['id'];

        // Delete subtasks
        $statement = $database->prepare('DELETE from lists WHERE task_id = :task_id');
        $statement->bindParam(':task_id', $taskID, PDO::PARAM_INT);
        $statement->execute();

        // Delete tasks
        $statement = $database->prepare('DELETE from tasks WHERE user_id  = :user_id');
        $statement->bindParam(':user_id', $id, PDO::PARAM_INT);
        $statement->execute();

        if (password_verify($password, $user['password'])) {
            $statement = $database->prepare('DELETE FROM users WHERE id = :id');
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();

            // Don't forget to delete users tasks and subtasks!

            $_SESSION['message'] = 'Your account has been deleted';

            redirect('/signin.php');
            session_destroy();
        } else {
            $_SESSION['error'] = 'Your password has been entered incorrectly.';
        }

        redirect('/delete.php');
    }


    redirect('/delete.php');
}
