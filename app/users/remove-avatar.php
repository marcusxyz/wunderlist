<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

$id = $_SESSION['user']['id'];
$userProfile = $_SESSION['user']['avatar'];

// Image upload

if (isset($_POST['remove-avatar'])) {
    $statement = $database->prepare('UPDATE users SET avatar = :avatar WHERE id = :id');
    $statement->bindParam(':avatar', $userProfile, PDO::PARAM_STR);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    // Updating session variable
    $_SESSION['user']['avatar'] = $userProfile;
    $_SESSION['message'] = 'Your profile picture has been removed';
    redirect('/profile.php');
} else {
    echo 'Something is not right';
}
redirect('/profile.php');
