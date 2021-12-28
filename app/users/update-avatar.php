<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

$id = $_SESSION['user']['id'];
$username = $_SESSION['user']['name'];
$email = $_SESSION['user']['email'];

// Image upload

if (isset($_FILES['avatar'])) {
    $avatar = $_FILES['avatar'];

    //Only allow .png and .jpg files.
    if (!in_array($avatar['type'], ['image/jpeg', ['image/png']])) {
        $_SESSION['error'] = 'You can only upload .jpeg or .png files.';
        redirect('/profile.php');
    }

    // Only allow images under 2MB
    if ($avatar['size'] > 2097152) {
        $_SESSION['error'] = 'The uploaded file needs to be 2MB or smaller';
        redirect('/profile.php');
    }


    $folderPath = __DIR__ . '/../../uploads/';
    $destination = $folderPath . date('ymd') . '-' . $_SESSION['user']['name'] . '-' . $avatar['name'];

    move_uploaded_file($avatar['tmp_name'], $destination);

    $_SESSION['message'] = 'Your profile picture has been updated!';
    redirect('/profile.php');
} else {
    $_SESSION['message'] = 'Its not working';
    redirect('/profile.php');
}
