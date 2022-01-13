<?php
require __DIR__ . '/app/autoload.php';
require __DIR__ . '/general/header.php';
require __DIR__ . '/general/notifications.php';

// I'm storing id from url in a session variable so I can use it in a function elsewhere
$_SESSION['taskID'] = $_GET['id'];

// Saving function to a new shorter variable
$editTask = editTasks($database);

?>

<!-- Edit user submitted tasks here -->
<section class="edit-task-container">

    <div class="message-container">
        <?php if ($error !== '') : ?>
            <p class="error"><?= $error; ?></p>
        <?php endif; ?>

        <?php if ($message !== '') : ?>
            <p class="success"><?php echo $message; ?></p>
        <?php endif; ?>
    </div>

    <a href="/" class="back-link">Go back</a>
    <div class="form-container">
        <div class="forms">
            <div class="task-info">
                <h1><?= $editTask['task_name']; ?></h1>
                <?php if ($editTask['status'] == 0) : ?>
                    <a href="/app/tasks/update/task-status-done.php" class="btn btn-stroke">Mark as done</a>
                <?php else : ?>
                    <a href="/app/tasks/update/task-status-undone.php" class="btn btn-stroke">Mark as undone</a>
                <?php endif; ?>
            </div>
            <p>In here you can edit your task, add checklist, update it and delete your task.</p>

            <form action="app/tasks/update/update-task.php" method="post" required>
                <div class="form">
                    <label for="task_name">Title</label>
                    <input type="text" name="task_name" id="task_name" value="<?= $editTask['task_name']; ?>" required>
                </div>
                <div class="form">
                    <label for="due_date">Due date</label>
                    <input type="datetime" name="due_date" id="due_date" placeholder="Please select a due date" value="<?= $editTask['due_date']; ?>" required>
                </div>
                <div class="form">
                    <label for="task_notes">Note</label>
                    <textarea type="text" name="task_notes" id="task_notes"><?= $editTask['task_notes']; ?></textarea>
                </div>
                <input type="hidden" name="id" id="<?= $task['id']; ?>">
                <div class="button-container">
                    <button type="submit" name="submit-task" class="btn btn-half">Save changes</button>
                    <a href="/app/tasks/delete/delete-task.php" class="btn btn-half delete">Delete task</a>

                </div>
            </form>
        </div>
        <div class="forms">
            <div class="subtask-container">
                <h2>Checklist</h2>
                <form action="app/subtasks/create/create-subtask.php" method="post">
                    <div class="form">
                        <label for="task_name">Add a subtask</label>
                        <input type="text" name="subtask_name" id="subtask_name" placeholder="Write something and press 'Enter'">
                        <input type="hidden" name="id" id="<?= $task['id']; ?>">
                        <input type="hidden" name="status" value="0">
                        <button type="submit" name="submit-subtask" class="btn btn-auto">Add</button>
                    </div>
                </form>

                <?php foreach (fetchSubTasks($database) as $subTask) : ?>
                    <div class="subtask-item">
                        <form action="app/subtasks/update/update-subtask-status.php" method="post" class="subtask">
                            <input type="hidden" name="id" id="<?= $task['id']; ?>">
                            <input type="hidden" name="subtask-id" value="<?= $subTask['id']; ?>">
                            <input type="hidden" name="subtask-name" value="<?= $subTask['subtask_name']; ?>">
                            <input type="hidden" name="subtask-status" value="<?= $subTask['status']; ?>">
                            <?php if ($subTask['status'] == 1) : ?>
                                <input type="checkbox" name="checkbox-toggle" id="checkbox-toggle" <?= 'checked="checked"' ?> />
                                <p class="checked"><?= $subTask['subtask_name']; ?></p>
                                <div>
                                    <a class="edit" href="/edit-subtask.php?id=<?= $subTask['id']; ?>&name=<?= $subTask['subtask_name']; ?>">Edit</a>
                                    <a class="delete" href="/app/subtasks/delete/delete-subtask.php?id=<?= $subTask['id']; ?>&name=<?= $subTask['subtask_name']; ?>">Delete</a>
                                </div>
                            <?php else : ?>
                                <input type="checkbox" name="checkbox-toggle" id="checkbox-toggle" />
                                <p><?= $subTask['subtask_name']; ?></p>
                                <div>
                                    <a href="/edit-subtask.php?id=<?= $subTask['id']; ?>&name=<?= $subTask['subtask_name']; ?>" class="edit">Edit</a>
                                    <a class="delete" href="/app/subtasks/delete/delete-subtask.php?id=<?= $subTask['id']; ?>&name=<?= $subTask['subtask_name']; ?>">Delete</a>
                                </div>
                            <?php endif; ?>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<?php
require __DIR__ . '/general/footer.php';
?>
