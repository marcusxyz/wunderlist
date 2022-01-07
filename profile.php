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

// SELF NOTE: Uncomment JS in order for profile change to work

?>

<!-- Manage your account -->
<section class="profile">
    <a href="/">Go back</a>
    <div class="change-pfp">
        <!-- <?php print_r($_SESSION['user']); ?> -->
        <div class="profile-container">
            <?php if (isset($userProfile)) : ?>
                <img src="/uploads/<?= $userProfile; ?>" alt="user selected profile picture">
            <?php else : ?>
                <img src="/uploads/default.jpeg" alt="Default profile picture">
            <?php endif; ?>
        </div>
        <div class="links">
            <form action="app/users/update/update-avatar.php" method="POST" enctype="multipart/form-data">
                <a href=""><label for="avatar" class="link-pfp">Change profile picture</label></a>
                <input type="file" id="avatar" name="avatar" accept=".jpg, .jpeg, .png, .gif" style=" display: none;">
                <input type="submit" style="display: none;">
            </form>
            <?php if (isset($userProfile)) : ?>
                <form action="app/users/delete/delete-avatar.php" method="POST" enctype="multipart/form-data">
                    <input type="submit" id="remove-avatar" name="remove-avatar" class="unlink-pfp" value="Remove profile picture">
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

    <form action="app/users/update/update-profile.php" method="post" class="account-settings">
        <div class="form">
            <label for="username">Username</label>
            <input type="username" name="username" id="username" value="<?= $_SESSION['user']['username']; ?>">
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
    </form>
    <a href="/delete.php" style="display: block;">
        <button class="btn secondary-full">Delete account</button>
    </a>

</section>

<script src="/assets/js/index.js"></script>
