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

    <h1>Sign in</h1>

    <?php if ($error !== '') : ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>

    <form action="app/users/signin-process.php" method="post">

        <div class="form">
            <label for="email">Email</label>
            <input class="form-input" type="email" name="email" id="email" required>
        </div>
        <div class="form">
            <label for="password">Password</label>
            <input class="form-input" type="password" name="password" id="password" required>
        </div>

        <button type="submit" class="btn btn-primary">Sign in</button>
        <small class="form-message">Don’t have an account yet? <a href="/signup.php">Sign up here</a></small>
    </form>
</article>
