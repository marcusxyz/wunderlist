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
