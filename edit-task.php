<?php
require __DIR__ . '/app/autoload.php';
require __DIR__ . '/general/header.php';
require __DIR__ . '/general/notifications.php';

function editTasks($database)
{
    $taskID = $_GET['id'];

    $statement = $database->prepare('SELECT * FROM tasks WHERE id = :id');
    $statement->bindParam(':id', $taskID, PDO::PARAM_INT);
    $statement->execute();

    $getTask = $statement->fetch(PDO::FETCH_ASSOC);
    return $getTask;
}
// Saving function to a new variable
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


            <form action="app/tasks/store.php" method="post" required>
                <div class="form">
                    <label for="task_name">Title</label>
                    <input type="task_name" name="task_name" id="task_name" value="<?= $editTask['task_name']; ?>" required>
                </div>
                <div class="form">
                    <label for="due_date">Due date</label>
                    <input type="datetime" name="due_date" id="due_date" placeholder="Please select a due date" value="<?= $editTask['due_date']; ?>" required>
                </div>
                <div class="form">
                    <label for="task_notes">Note</label>
                    <textarea type="text" name="task_notes" id="task_notes"><?= $editTask['task_notes']; ?></textarea optional>
                    </div>

                    <button type="submit" name="submit-task" class="btn btn-full">Save changes</button>
                    <button type="submit" name="submit-task" class="btn secondary-full done">Mark as done</button>
                </form>
        </div>
    </article>

</section>

<?php
require __DIR__ . '/general/footer.php';
?>
