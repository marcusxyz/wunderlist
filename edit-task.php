<?php
require __DIR__ . '/app/autoload.php';
require __DIR__ . '/general/header.php';
require __DIR__ . '/general/notifications.php';

foreach (fetchTasks($database) as $task) {
}

$taskID = $_GET['id'];

function editTasks($database)
{
    $taskID = $_GET['id'];

    $statement = $database->prepare('SELECT * FROM tasks WHERE id = :id');
    $statement->bindParam(':id', $taskID, PDO::PARAM_INT);
    $statement->execute();

    $getTask = $statement->fetch(PDO::FETCH_ASSOC);
    return $getTask;
}
?>
<!-- Sign me in here -->
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
            <?php echo $taskID; ?>
            <?php print_r(editTasks($database)); ?>
            <form action="app/tasks/store.php" method="post" required>
                <div class="form">
                    <label for="task_name">Title</label>
                    <input type="task_name" name="task_name" id="task_name" value="<?= $editTask['task_name']; ?>" required>
                </div>
                <div class="form">
                    <label for="due_date">Due date</label>
                    <input type="datetime" name="due_date" id="due_date" placeholder="Please select a due date" value="<?= $task['due_date']; ?>" required>
                </div>
                <div class="form">
                    <label for="task_notes">Note</label>
                    <textarea type="text" name="task_notes" id="task_notes"><?= $task['task_notes']; ?></textarea optional>
                    </div>

                    <button type="submit" name="submit-task" class="btn btn-full">Save changes</button>
                </form>

        </div>
    </article>

</section>

<?php
require __DIR__ . '/general/footer.php';
?>