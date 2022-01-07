<nav class="navbar">
    <a href="/index.php"><?= $config['title']; ?></a>

    <ul>
        <li class="nav-item">
            <?php if (isset($_SESSION['user'])) : ?>
                <a href="/index.php">My tasks</a>
                <a href="/profile.php">Profile</a>
                <a href="/app/users/create/signout-process.php">Sign out</a>
            <?php else : ?>
                <a href="/app/users/create/signup-process.php">Sign up</a>
            <?php endif; ?>
        </li>
    </ul>
</nav>
