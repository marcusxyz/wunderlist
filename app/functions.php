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

    $statement = $database->query('SELECT * FROM tasks WHERE user_id = :user_id AND due_date != :due_date AND status = :status ORDER BY due_date DESC');
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

function searchTasks(PDO $database, $search): array
{

    $search = "%$search%";
    $userID = $_SESSION['user']['id'];

    $statement = $database->prepare('SELECT * FROM tasks WHERE task_name LIKE :search AND user_id = :user_id');
    $statement->bindParam(':user_id', $userID, PDO::PARAM_STR);
    $statement->bindParam(':search', $search, PDO::PARAM_STR);
    $statement->execute();

    $getTasks = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $getTasks;
}


// Function using Mailtrap sends email when register
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendMail()
{

    require __DIR__ . '/../welcomeEmail/src/Exception.php';
    require __DIR__ . '/../welcomeEmail/src/PHPMailer.php';
    require __DIR__ . '/../welcomeEmail/src/SMTP.php';


    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Username = '40b335426a4187';
    $mail->Password = '39081dda571bc9';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 2525;

    $mail->setFrom('info@mailtrap.io', 'Mailtrap');
    $mail->addReplyTo('info@mailtrap.io', 'Mailtrap');
    $mail->addAddress('recipient1@mailtrap.io', 'Susanne');
    $mail->addCC('cc1@example.com', 'Elena');
    $mail->addBCC('bcc1@example.com', 'Alex');

    $mail->isHTML(true);
    $mail->Subject = 'Welcome to Wunderlist';
    $mail->Body = '<h1> We are glad to have you as a new member! </h1>';
    $mail->AltBody = 'Start creating and editing your tasks today.';

    if ($mail->send()) {
        echo 'Message has been sent';
    } else {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
}
