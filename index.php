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

// Store returned data as variables
$uncompletedTasks = fetchTasks($database);
$completedTasks = taskCompleted($database);
$taskDueToday = fetchTodaysTasks($database);

?>
<main>
    <!-- Here is where the tasks will be -->
    <div class="welcome-content">
        <?php if ($message !== '') : ?>
            <p class="success"><?php echo $message; ?></p>
        <?php endif; ?>
        <h1>Welcome <?= $_SESSION['user']['username']; ?></h1>
        <?php if (count($uncompletedTasks) == 0 && (count($taskDone) == 0)) : ?>
            <p>Start by making a new task below!</p>
        <?php elseif (count($taskDueToday) > 0) : ?>
            <p>Your have <strong><?php print_r(count($taskDueToday)); ?></strong> task that needs to be done today.</p>
        <?php endif; ?>
        <!--  -->
        <a href="/create-task.php">
            <button class="btn btn-half">New task</button>
        </a>
    </div>
    <!-- <?php print_r($_SESSION['user']); ?> -->
    <br>
    <!-- <?php print_r($_SESSION['tasks']); ?> -->
    <?php if (count($uncompletedTasks) !== 0) : ?>
        <h2>Todays tasks</h2>
        <section class="task-container">
            <?php foreach ($taskDueToday as $task) : ?>
                <a class="task-item" href="/edit-task.php?id=<?= $task['id']; ?>">
                    <div>
                        <div class="task-item-title">
                            <h3><?= $task['task_name']; ?></h3>
                            <p><?= $task['task_notes']; ?></p>
                            <div class="due-date">
                                <svg width="16" height="19" viewBox="0 0 16 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="8" cy="11" r="7" stroke="var(--black)" stroke-opacity="0.9" stroke-width="2" />
                                    <rect x="5" width="6" height="2" fill="var(--black)" fill-opacity="0.9" />
                                    <rect x="9" y="6" width="6" height="2" transform="rotate(90 9 6)" fill="var(--black)" fill-opacity="0.9" />
                                </svg>
                                <span>
                                    <?= $task['due_date']; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
        </section>

        <?php if (count($taskDueToday) !== 0) : ?>
            <h2>Your tasks</h2>
        <?php endif; ?>
        <?php if (count($uncompletedTasks) == 0 && count($taskDueToday) == 0 && count($completedTasks) == 0) : ?>
            <h2>Your tasks</h2>
            <div class="task-item empty">
                <div class="task-item-title">
                    <h3>📝 No task created 📝</h3>
                    <p>Your newly created tasks will show up here.</p>
                </div>
            </div>
        <?php endif; ?>
        <?php if (count($uncompletedTasks) == 0 && count($taskDueToday) == 0 && count($completedTasks) !== 0) : ?>
            <div class="task-item empty">
                <div class="task-item-title">
                    <h3>💫 Awesome, you’re all caught up! 💫</h3>
                    <p>Great job, now go ahead and take a break, or do what you do best!</p>
                </div>
            </div>
        <?php else : ?>
            <section class="task-container">
                <?php foreach ($uncompletedTasks as $task) : ?>
                    <a class="task-item" href="/edit-task.php?id=<?= $task['id']; ?>">
                        <div>
                            <div class="task-item-title">
                                <h3><?= $task['task_name']; ?></h3>
                                <p><?= $task['task_notes']; ?></p>
                            </div>
                            <div class="due-date">
                                <svg width="16" height="19" viewBox="0 0 16 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="8" cy="11" r="7" stroke="var(--black)" stroke-opacity="0.9" stroke-width="2" />
                                    <rect x="5" width="6" height="2" fill="var(--black)" fill-opacity="0.9" />
                                    <rect x="9" y="6" width="6" height="2" transform="rotate(90 9 6)" fill="var(--black)" fill-opacity="0.9" />
                                </svg>
                                <span>
                                    <?= $task['due_date']; ?>
                                </span>
                            </div>

                        </div>
                    </a>
                <?php endforeach; ?>
            </section>
        <?php endif; ?>

        <h2>Completed</h2>
        <?php if (count($completedTasks) == 0) : ?>
            <div class="task-item empty">
                <div class="task-item-title">
                    <h3>✅ You can do it! ✅</h3>
                    <p>Your completed tasks will show up here.</p>
                </div>
            </div>
        <?php else : ?>
            <section class="task-container complete">
                <?php foreach ($completedTasks as $task) : ?>
                    <a class="task-item completed" href="/edit-task.php?id=<?= $task['id']; ?>">
                        <div>
                            <div class="overlay"></div>
                            <div class="task-item-title">
                                <h3><?= $task['task_name']; ?></h3>
                                <p><?= $task['task_notes']; ?></p>
                            </div>
                            <div class="due-date">
                                <svg width="16" height="19" viewBox="0 0 16 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="8" cy="11" r="7" stroke="#1A1B1C" stroke-opacity="0.9" stroke-width="2" />
                                    <rect x="5" width="6" height="2" fill="#1A1B1C" fill-opacity="0.9" />
                                    <rect x="9" y="6" width="6" height="2" transform="rotate(90 9 6)" fill="#1A1B1C" fill-opacity="0.9" />
                                </svg>
                                <span>
                                    <?= $task['due_date']; ?>
                                </span>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </section>
        <?php endif; ?>
</main>

<script src="/assets/js/index.js"></script>
