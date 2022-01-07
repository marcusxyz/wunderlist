<?php
require __DIR__ . '/app/autoload.php';
require __DIR__ . '/general/header.php';
require __DIR__ . '/general/notifications.php';

$subTaskID = $_GET['id'];
$subTaskName = $_GET['name'];
?>

<!-- Edit user submitted tasks here -->
<section class="edit-task-container">

    <article>
        <div class="form-content">
            <h1>Edit subtask</h1>
            <p>In here you can edit your subtask</p>

            <?php if ($error !== '') : ?>
                <p class="error"><?= $error; ?></p>
            <?php endif; ?>

            <?php if ($message !== '') : ?>
                <p class="success"><?php echo $message; ?></p>
            <?php endif; ?>

            <!-- <?php print_r($_SESSION['task']); ?> -->
            <!-- <?php print_r($_SESSION['subtask']); ?> -->
            <?= $subTaskName ?>
            <br>
            <?= $subTaskID ?>
            <br>
            <form action="app/subtasks/update/update-subtask.php" method="post" required>
                <div class="form">
                    <label for="task_name">Change subtask title</label>
                    <input type="hidden" name="subtask-id" id="id" value="<?= $subTaskID ?>">
                    <input type="text" name="subtask-name" id="subtask_name" value="<?= $subTaskName; ?>" required>
                </div>
                <div class="button-container">
                    <button type="submit" name="save-subtask" class="btn btn-half">Save changes</button>
                    <button type="submit" name="delete-subtask" class="btn btn-half delete">Delete subtask</button>
                </div>
            </form>
        </div>
    </article>
</section>

<?php
require __DIR__ . '/general/footer.php';
?>
