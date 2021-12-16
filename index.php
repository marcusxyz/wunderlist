<?=
require __DIR__ . '/app/autoload.php';
require __DIR__ . '/general/header.php';

// If user is not signed in, send user to /signin.php
if (!isset($_SESSION['user'])) {
    header('Location: /signin.php');
}

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

// $passord = '123';
// $hash = password_hash($passord, PASSWORD_DEFAULT);

// echo $hash;

?>

<!-- Here is where the tasks will be -->

<article>

    <h1><?php echo $config['title']; ?></h1>

    <!-- Welcome message -->
    <?php if ($message !== '') : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

</article>
