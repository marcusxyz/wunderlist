<?php

declare(strict_types=1);

require __DIR__ . '/app/autoload.php';
require __DIR__ . '/general/header.php';
require __DIR__ . '/general/notifications.php';

?>

<!-- Manage your account -->
<section class="profile">
    <a href="/">Go back</a>

    <div class="change-pfp">
        <div class="image-container">
            <img src="#" alt="">
        </div>
        <a href="" class="link-pfp">Change profile picture</a>
    </div>

    <?php if ($error !== '') : ?>
        <p class="error"><?= $error; ?></p>
    <?php endif; ?>
    <form class="account-settings" action="app/users//update.php" method="post">
        <div class="form">
            <label for="name">Username</label>
            <input type="name" name="name" id="name" required>
        </div>
        <div class="form">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
        </div>
        <p>Feel free to update your password so your
            account stays secure.</p>
        <div class="form">
            <label for="password">Old password</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div class="form">
            <label for="password-new">New password</label>
            <input type="password" name="password-new" id="password-new" required>
        </div>
        <div class="form">
            <label for="password-confirm">Confirm password</label>
            <input type="password" name="password-confirm" id="password-confirm" required>
        </div>
    </form>
    <button type="submit" name="save-changes" class="btn btn-full">Save changes</button>
    <button type="submit" name="save-changes" class="btn secondary-full">Delete account</button>

</section>
