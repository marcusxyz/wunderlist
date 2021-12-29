<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

$id = $_SESSION['user']['id'];
$userProfile = $_SESSION['user']['avatar'];

// Image upload

if (isset($_FILES['avatar'])) {
    $avatar = $_FILES['avatar'];

    //Only allow .png and .jpg files.
    if (!in_array($avatar['type'], ['image/jpeg', 'image/pmg'])) {
        $_SESSION['error'] = 'You can only upload .jpeg or .png files.';
        redirect('/profile.php');
    }

    // Only allow images under 2MB
    if ($avatar['size'] > 2097152) {
        $_SESSION['error'] = 'The uploaded file needs to be 2MB or smaller';
        redirect('/profile.php');
    }

    $userProfile = $id . '-' . date('ymd') . '-' . $avatar['name'];
    $folderPath = __DIR__ . '/../../uploads/';
    $destination = $folderPath . $userProfile;

    move_uploaded_file($avatar['tmp_name'], $destination);

    $statement = $database->prepare('UPDATE users SET avatar = :avatar WHERE id = :id');
    $statement->bindParam(':avatar', $userProfile, PDO::PARAM_STR);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    // Updating session variable
    $_SESSION['user']['avatar'] = $userProfile;
    $_SESSION['message'] = 'Your profile picture has been updated!';
    redirect('/profile.php');
} else {
    $_SESSION['message'] = 'Its not working';
    redirect('/profile.php');
}
