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

    <article>
        <div class="form-content">
            <h1>Edit task</h1>

            <?php if ($error !== '') : ?>
                <p class="error"><?= $error; ?></p>
            <?php endif; ?>

            <?php if ($message !== '') : ?>
                <p class="success"><?php echo $message; ?></p>
            <?php endif; ?>

            <?php print_r($_SESSION['task']); ?>
            <?php print_r($_SESSION['subtask']); ?>
            <form action="app/tasks//update/update-task.php" method="post" required>
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
                    <button type="submit" name="submit-task" class="btn btn-half delete">Delete task</button>
                </div>
            </form>

            <div class="subtask-container">
                <h2>Create a checklist for your task</h2>
                <form action="app/subtasks/create/create-subtask.php" method="post">
                    <div class="form">
                        <label for="task_name">Add a task item</label>
                        <input type="text" name="subtask_name" id="subtask_name" placeholder="Write something and press 'Enter'">
                        <input type="hidden" name="id" id="<?= $task['id']; ?>">
                        <input type="hidden" name="status" value="0">
                        <button type="submit" name="submit-subtask" class="btn btn-auto">Add</button>
                    </div>
                </form>
                <?php foreach (fetchSubTasks($database) as $subTask) : ?>
                    <div class="subtask-item">
                        <form action="app/subtasks/update/update-subtask-status.php" method="post">
                            <input type="hidden" name="id" id="<?= $task['id']; ?>">
                            <input type="hidden" name="subtask-id" value="<?= $subTask['id']; ?>">
                            <input type="hidden" name="subtask-name" value="<?= $subTask['subtask_name']; ?>">
                            <input type="hidden" name="subtask-status" value="<?= $subTask['status']; ?>">
                            <input type="checkbox" name="checkbox-toggle" id="checkbox-toggle" value="<?= $subTask['status']; ?>" <?php if ($subTask['status'] == 1) {
                                                                                                                                        echo 'checked="checked"';
                                                                                                                                    } ?> />
                        </form>
                        <p><?= $subTask['subtask_name']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </article>
</section>

<?php
require __DIR__ . '/general/footer.php';
?>
