<?php
require __DIR__ . '/app/autoload.php';
require __DIR__ . '/general/header.php';
require __DIR__ . '/general/notifications.php';
?>

<!-- Sign me in here -->
<section class="signinout-container">
    <div class="image-container">
        <img src="/assets/images/main-img-min.webp" alt="">
    </div>

    <article>
        <div class="form-content">
            <h1>Sign up</h1>

            <?php if ($error !== '') : ?>
                <p class="error"><?= $error; ?></p>
            <?php endif; ?>
            <form action="app/users/signup-process.php" method="post">
                <div class="form">
                    <label for="name">Username</label>
                    <input type="name" name="name" id="name" required>
                </div>
                <div class="form">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="form">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                    <small class="form-message password">Password needs to be atleast 8 characters long.</small>
                </div>
                <div class="form">
                    <label for="password-confirm">Confirm password</label>
                    <input type="password" name="password-confirm" id="password-confirm" required>
                </div>

                <button type="submit" name="submit" class="btn btn-full">Sign up</button>
                <small class="form-message">Do you have an account? <a href="/signin.php">Sign in here</a></small>
            </form>
        </div>
    </article>

</section>
