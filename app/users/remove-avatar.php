<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

$id = $_SESSION['user']['id'];
$userProfile = $_SESSION['user']['avatar'];

// Image upload

if (isset($_POST['remove-avatar'])) {
    $removeImage = null;

    if (file_exists($userProfile)) {
        $destination = __DIR__ . '/../../uploads/' . $userProfile;
        unlink($destination);
    }

    $statement = $database->prepare('UPDATE users SET avatar = :avatar WHERE id = :id');
    $statement->bindParam(':avatar', $removeImage, PDO::PARAM_NULL);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    // Updating session variable
    $_SESSION['user']['avatar'] = $removeUserImage;
    // $_SESSION['error'] = 'Your profile picture has been removed';
    redirect('/profile.php');
} else {
    echo 'We have a problem somewhere';
}
redirect('/profile.php');
