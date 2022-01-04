<?php
require __DIR__ . '/app/autoload.php';
require __DIR__ . '/general/header.php';
require __DIR__ . '/general/notifications.php';
?>

<!-- Sign me in here -->
<section class="signinout-container">

    <article>
        <div class="form-content">
            <h1>New task</h1>

            <?php if ($error !== '') : ?>
                <p class="error"><?= $error; ?></p>
            <?php endif; ?>

            <?php if ($message !== '') : ?>
                <p class="success"><?php echo $message; ?></p>
            <?php endif; ?>

            <form action="app/tasks/store.php" method="post" required>
                <div class="form">
                    <label for="task_name">Title</label>
                    <input type="task_name" name="task_name" id="task_name" required>
                </div>
                <div class="form">
                    <label for="due_date">Due date</label>
                    <input type="datetime" name="due_date" id="due_date" placeholder="Please select a due date" required>
                </div>
                <div class="form">
                    <label for="task_notes">Note</label>
                    <textarea type="text" name="task_notes" id="task_notes"></textarea optional>
                </div>

                <button type="submit" name="submit-task" class="btn btn-full">Add new task</button>
            </form>
        </div>
    </article>

</section>

<?php
require __DIR__ . '/general/footer.php';
?>
