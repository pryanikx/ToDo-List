<header>
    <h1>ToDo List!</h1>
</header>
<div class="content">
<a href="/Task/create" class="button">Add task</a>
<?php foreach($data as $task): ?>
    <h3><?= $task["category"]; ?></h3>
    <p><?= $task["description"]; ?></p>
    <p>status: <?= $task["status"]; ?></p>
    <p>created at: <?= $task["created_at"]; ?></p>
    <p>deadline: <?= $task["deadline"]; ?></p>
    <a href="/Task/update/<?= htmlspecialchars($task['id']); ?>" class="button">Edit</a>

    <form action="/Task/delete/<?= htmlspecialchars($task['id']); ?>" method="post">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
        <button class="button" type="submit" onclick="return confirm('Вы уверены, что хотите удалить задачу?')">Delete</button>
    </form>

    <!-- // TODO: add ability to change the status of the task -->
    <!-- // TODO: change delete button: use ajax instead of simple form-->
<?php endforeach ?>
</div>
<footer>
    <p>&copy; <?= date('Y') ?> pernikkov</p>
</footer>