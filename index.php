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
<main>

    <!-- Here is where the tasks will be -->
    <div class="welcome-content">
        <?php if ($message !== '') : ?>
            <p class="success"><?php echo $message; ?></p>
        <?php endif; ?>
        <h1>Welcome <?= $_SESSION['user']['username']; ?></h1>
        <?php if (empty(fetchTasks($database) && empty(taskCompleted($database)))) : ?>
            <p>Start by making a new task below!</p>
        <?php endif; ?>
        <a href="/create-task.php">
            <button class="btn btn-half">New task</button>
        </a>
    </div>
    <!-- <?php print_r($_SESSION['user']); ?> -->
    <br>
    <!-- <?php print_r($_SESSION['tasks']); ?> -->
    <section class="task-container">
        <?php if (!empty(fetchTodaysTasks($database))) : ?>
            <h2>Todays tasks</h2>
            <?php foreach (fetchTodaysTasks($database) as $task) : ?>
                <a href="/edit-task.php?id=<?= $task['id']; ?>">
                    <div class="task-item red">
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
                            <p>
                                <?= $task['due_date']; ?>
                            </p>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>

    <section class="task-container">
        <?php if (!empty(fetchTasks($database))) : ?>
            <h2>Your tasks</h2>
        <?php endif; ?>
        <?php if (empty(fetchTasks($database)) && empty(taskCompleted($database)) && empty(fetchTodaysTasks($database))) : ?>
            <h2>Your tasks</h2>
            <div class="task-item empty">
                <div class="task-item-title">
                    <h3>📝 No task created 📝</h3>
                    <p>Your newly created tasks will show up here.</p>
                </div>
            </div>
        <?php endif; ?>
        <?php if (empty(fetchTodaysTasks($database)) && empty(fetchTasks($database)) && !empty(taskCompleted($database))) : ?>
            <div class="task-item empty">
                <div class="task-item-title">
                    <h3>💫 Awesome, you’re all caught up! 💫</h3>
                    <p>Great job, now go ahead and take a break, or do what you do best!</p>
                </div>
            </div>
        <?php else : ?>
            <?php foreach (fetchTasks($database) as $task) : ?>
                <a href="/edit-task.php?id=<?= $task['id']; ?>">
                    <div class="task-item" id="task-item">
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
                            <p>
                                <?= $task['due_date']; ?>
                            </p>
                        </div>

                    </div>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>

    <section class="task-container complete">
        <h2>Completed</h2>
        <?php if (empty(taskCompleted($database))) : ?>
            <div class="task-item empty">
                <div class="task-item-title">
                    <h3>✅ You can do it! ✅</h3>
                    <p>Your completed tasks will show up here.</p>
                </div>
            </div>
        <?php else : ?>
            <?php foreach (taskCompleted($database) as $task) : ?>
                <a href="/edit-task.php?id=<?= $task['id']; ?>">
                    <div class="task-item completed">
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
                            <p>
                                <?= $task['due_date']; ?>
                            </p>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>
</main>

<script src="/assets/js/index.js"></script>
