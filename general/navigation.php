<nav class="navbar">
    <a href="/index.php"><?= $config['title']; ?></a>

    <ul>
        <li class="nav-item">
            <?php if (isset($_SESSION['user'])) : ?>
                <a href="/index.php">My tasks</a>
                <a href="/account.php">Profile</a>
                <a href="/app/users/signout-process.php">Sign out</a>
            <?php else : ?>
                <a href="/app/users/signup-process.php">Sign up</a>
            <?php endif; ?>
        </li>
    </ul>
</nav>
