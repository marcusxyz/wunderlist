<?php
require __DIR__ . '/app/autoload.php';
require __DIR__ . '/general/header.php';
require __DIR__ . '/general/notifications.php';

$subTaskID = $_GET['id'];
$subTaskName = $_GET['name'];
$id = $_SESSION['tasks']['id'];
?>

<!-- Edit user submitted tasks here -->
<section class="form-container">
    <div class="edit-subtask">
        <a href="/edit-task.php?id=<?= $id ?>">Go back</a>
        <h1>Edit subtask</h1>

        <?php if ($error !== '') : ?>
            <p class="error"><?= $error; ?></p>
        <?php endif; ?>

        <?php if ($message !== '') : ?>
            <p class="success"><?php echo $message; ?></p>
        <?php endif; ?>

        <form action="app/subtasks/update/update-subtask.php" method="post" required>
            <div class="form">
                <label for="task_name">Change subtask title</label>
                <input type="hidden" name="subtask-id" id="id" value="<?= $subTaskID ?>">
                <input type="text" name="subtask-name" id="subtask_name" value="<?= $subTaskName; ?>" required>
            </div>
            <div class="button-container">
                <button type="submit" name="save-subtask" class="btn btn-half">Save changes</button>
            </div>
        </form>
    </div>
</section>

<?php
require __DIR__ . '/general/footer.php';
?>
