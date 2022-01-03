<?php

declare(strict_types=1);

require __DIR__ . '/app/autoload.php';
require __DIR__ . '/general/header.php';
require __DIR__ . '/general/notifications.php';

// If user is not signed in, send user to /signin.php
if (!isset($_SESSION['user'])) {
    redirect('/signin.php');
}

?>

<!-- Manage your account -->
<section class="profile">

    <h1>Delete your account</h1>
    <h4></h4>

    <p>Please enter 'DELETE' and your password to confirm that you wish to delete your account. Once confirmed, this account will no longer be available and all data in the account will be permanently deleted.</p>

    <?php if ($error !== '') : ?>
        <p class="error"><?= $error; ?></p>
    <?php endif; ?>

    <?php if ($message !== '') : ?>
        <p class="success"><?php echo $message; ?></p>
    <?php endif; ?>

    <form action="app/users/delete-profile.php" method="post" class="account-settings">
        <div class="form">
            <label for="delete">Type DELETE to confirm</label>
            <input type="delete" name="delete" id="delete">
        </div>
        <div class="form">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="••••••••">
        </div>
        <button type="submit" class="btn secondary-full">Delete my account</button>
    </form>
    <a href="/profile.php" style="display: block;">
        <button class="btn btn-full">Nevermind, keep my account</button>
    </a>

</section>

<script src="/assets/js/index.js"></script>
