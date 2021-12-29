<?php

declare(strict_types=1);

require __DIR__ . '/app/autoload.php';
require __DIR__ . '/general/header.php';
require __DIR__ . '/general/notifications.php';

// If user is not signed in, send user to /signin.php
if (!isset($_SESSION['user'])) {
    redirect('/signin.php');
}

$userProfile = $_SESSION['user']['avatar'];

?>

<!-- Manage your account -->
<section class="profile">
    <a href="/">Go back</a>
    <div class="change-pfp">
        <?= $userProfile; ?>
        <div class="profile-container">
            <?php if (file_exists(__DIR__ . '/uploads/' . $userProfile)) : ?>
                <img src="/uploads/<?= $userProfile; ?>" alt="default profile picture for the user">
            <?php else : ?>
                <img src="/uploads/default.jpeg" alt="Default profile picture">
            <?php endif; ?>
        </div>
        <div class="links">
            <form action="app/users/update-avatar.php" method="POST" enctype="multipart/form-data">
                <label for="avatar" class="link-pfp">Change profile picture</label>
                <input type="file" id="avatar" name="avatar" accept=".jpg, .jpeg, .png" style=" display: none;">
                <input type="submit" style="display: none;">
            </form>
            <?php if (file_exists(__DIR__ . '/uploads/' . $userProfile)) : ?>
                <form action="app/users/remove-avatar.php" method="POST" enctype="multipart/form-data">
                    <!-- <input type="file" id="avatar" name="avatar" accept=".jpg, .jpeg, .png" style=" display: none;"> -->
                    <input type="submit" class="unlink-pfp" value="Remove profile picture">
                </form>
            <?php endif; ?>

        </div>
    </div>

    <?php if ($error !== '') : ?>
        <p class="error"><?= $error; ?></p>
    <?php endif; ?>

    <?php if ($message !== '') : ?>
        <p class="success"><?php echo $message; ?></p>
    <?php endif; ?>

    <form action="app/users/update-profile.php" method="post" class="account-settings">
        <div class="form">
            <label for="name">Username</label>
            <input type="name" name="name" id="name" value="<?= $_SESSION['user']['name']; ?>">
        </div>
        <div class="form">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?= $_SESSION['user']['email']; ?>">
        </div>
        <p>Feel free to update your password so your
            account stays secure.</p>
        <div class="form">
            <label for="password">Old password</label>
            <input type="password" name="password" id="password">
        </div>
        <div class="form">
            <label for="password-new">New password</label>
            <input type="password" name="password-new" id="password-new">
        </div>
        <div class="form">
            <label for="password-confirm">Confirm password</label>
            <input type="password" name="password-confirm" id="password-confirm">
        </div>
        <button type="submit" name="save-changes" class="btn btn-full">Save Changes</button>
        <button type="submit" name="delete-user" class="btn secondary-full">Delete account</button>
    </form>

</section>

<script src="/assets/js/index.js"></script>
