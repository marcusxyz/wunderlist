<?=
require __DIR__ . '/app/autoload.php';
require __DIR__ . '/general/header.php';

$errors = $_SESSION['error-message'] ?? '';
unset($_SESSION['error-message']);

?>

<!-- Sign me in here -->

<div class="image-container">
    <img src="" alt="">
</div>

<article>
    <h1>Sign up</h1>

    <?php if ($errors !== '') : ?>
        <div class="error">
            <?php echo $errors; ?>
        </div>
    <?php endif; ?>

    <form action="app/users/signup-process.php" method="post">
        <div class="form">
            <label for="email">Name</label>
            <input class="form-input" type="name" name="name" id="name">
        </div>
        <div class="form">
            <label for="email">Email</label>
            <input class="form-input" type="email" name="email" id="email">
        </div>
        <div class="form">
            <label for="password">Password</label>
            <input class="form-input" type="password" name="password" id="password">
        </div>
        <div class="form">
            <label for="password-confirm">Confirm password</label>
            <input class="form-input" type="password" name="password-confirm" id="password-confirm">
        </div>
        <small class="form-message password">Use 8 or more characters with a mix of letters, numbers & symbols</small>

        <button type="submit" name="submit-signup" class="btn btn-primary">Sign up</button>
        <small class="form-message">Do you have an account? <a href="/signin.php">Sign in here</a></small>
    </form>
</article>
