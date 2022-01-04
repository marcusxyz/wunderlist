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
<?php print_r($_SESSION['user']); ?>
<br>
<!-- <?php print_r($_SESSION['tasks']); ?> -->

<section class="task-container">
    <?php if (empty(fetchTasks($database))) : ?>
        <div class="task-item empty">
            <h3>Awesome, you’re all caught up!</h3>
            <p>Great job, now go ahead and take a break, or do what you do best!</p>
        </div>
    <?php endif; ?>
    <?php foreach (fetchTasks($database) as $task) : ?>
        <a href="/edit-task.php?id=<?= $task['id']; ?>">
            <div class="task-item red">
                <h3><?= $task['task_name']; ?></h3>
                <p><?= $task['task_notes']; ?></p>
                <div class="due-date">
                    <svg width="16" height="19" viewBox="0 0 16 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="8" cy="11" r="7" stroke="#1A1B1C" stroke-opacity="0.9" stroke-width="2" />
                        <rect x="5" width="6" height="2" fill="#1A1B1C" fill-opacity="0.9" />
                        <rect x="9" y="6" width="6" height="2" transform="rotate(90 9 6)" fill="#1A1B1C" fill-opacity="0.9" />
                    </svg>
                    <p>
                        <?= $task['due_date']; ?>
                    </p>
                </div>
            </div>
        </a>
    <?php endforeach; ?>
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
