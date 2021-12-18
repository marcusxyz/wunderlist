<?=
require __DIR__ . '/app/autoload.php';
require __DIR__ . '/general/header.php';
require __DIR__ . '/general/notifications.php';

// If user is not signed in, send user to /signin.php
if (!isset($_SESSION['user'])) {
    redirect('/signin.php');
}

// $passord = '123';
// $hash = password_hash($passord, PASSWORD_DEFAULT);

?>

<!-- Here is where the tasks will be -->

<article>
    <h1><?php echo $config['title']; ?></h1>

    <?php if ($message !== '') : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
</article>
