<?php
require __DIR__ . '/app/autoload.php';
require __DIR__ . '/general/header.php';
require __DIR__ . '/general/notifications.php';

// If user is not signed in, send user to /signin.php
if (!isset($_SESSION['user'])) {
    redirect('/signin.php');
}

if (isset($_POST['new-task'])) {
    redirect('/new-task.php');
}

?>

<!-- Here is where the tasks will be -->

<div class="welcome-content">
    <?php if ($message !== '') : ?>
        <p class="success"><?php echo $message; ?></p>
    <?php endif; ?>
    <h1>Your tasks</h1>
    <p>Start by making a new task below!</p>
    <a href="/new-task.php">
        <button class="btn btn-half">New task</button>
    </a>
</div>

<section class="task-container">
    <div class="task-item empty">
        <h3>Awesome, you’re all caught up!</h3>
        <p>Great job, now go ahead and take a break, or do what you do best!</p>
    </div>
    <div class="task-item red"></div>
    <div class="task-item yellow"></div>
    <div class="task-item blue"></div>
</section>

<div class="completed">
    <h2>Completed</h2>
</div>
<section class="task-container complete">
    <div class="task-item empty">
        <h3>You can do it!</h3>
        <p>Your completed tasks will show up here once it’s done.</p>
    </div>
    <div class="task-item"></div>
</section>
