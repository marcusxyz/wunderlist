<?php
require __DIR__ . '/app/autoload.php';
require __DIR__ . '/general/header.php';
require __DIR__ . '/general/notifications.php';
?>

<!-- Sign me in here -->
<section class="signinout-container">
    <div class="image-container">
        <img src="/assets/images/signin-bg.jpeg" alt="">
    </div>

    <article>
        <div class="form-content">

            <h1>Sign in</h1>

            <?php if ($error !== '') : ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>

            <?php if ($message !== '') : ?>
                <p class="success"><?php echo $message; ?></p>
            <?php endif; ?>

            <form class="sign-in" action="app/users/create/signin-process.php" method="post">

                <div class="form">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email" required>
                </div>
                <div class="form">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn btn-full">Sign in</button>
                <small class="form-message">Don’t have an account yet? <a class="highlight" href="/signup.php">Sign up here</a></small>
            </form>
        </div>
    </article>
</section>
