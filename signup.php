<?php
require __DIR__ . '/app/autoload.php';
require __DIR__ . '/general/header.php';
require __DIR__ . '/general/notifications.php';
?>

<!-- Sign me in here -->

<div class="image-container">
    <img src="" alt="">
</div>

<article>
    <h1>Sign up</h1>

    <?php if ($error !== '') : ?>
        <p><?= $error; ?></p>
    <?php endif; ?>

    <form action="app/users/signup-process.php" method="post">
        <div class="form">
            <label for="email">Username</label>
            <input class="form-input" type="name" name="name" id="name" required>
        </div>
        <div class="form">
            <label for="email">Email</label>
            <input class="form-input" type="email" name="email" id="email" required>
        </div>
        <div class="form">
            <label for="password">Password</label>
            <input class="form-input" type="password" name="password" id="password" required>
        </div>
        <div class="form">
            <label for="password-confirm">Confirm password</label>
            <input class="form-input" type="password" name="password-confirm" id="password-confirm" required>
        </div>
        <small class="form-message password">Password needs to be atleast 8 characters long.</small>

        <button type="submit" name="submit-signup" class="btn btn-primary">Sign up</button>
        <small class="form-message">Do you have an account? <a href="/signin.php">Sign in here</a></small>
    </form>
</article>
