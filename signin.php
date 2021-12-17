<?=
require __DIR__ . '/app/autoload.php';
require __DIR__ . '/general/header.php';

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

?>

<!-- Sign me in here -->

<div class="image-container">
    <img src="" alt="">
</div>

<article>

    <h1>Sign in</h1>
    <form action="app/users/signin-process.php" method="post">
        <?php if ($message !== '') : ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
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
