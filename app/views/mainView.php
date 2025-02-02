<div class="content">
<?php foreach($data as $task): ?>
    <h3>
        <span class="task-circle" style="background-color: <?= htmlspecialchars($task['color']); ?>;"></span>
        <?= htmlspecialchars($task["name"]); ?>
    </h3>
    <p><?= htmlspecialchars($task["description"]); ?></p>
    <p>status: <?= htmlspecialchars($task["status"]); ?></p>
    <p>created at: <?= htmlspecialchars($task["created_at"]); ?></p>
    <p>deadline: <?= htmlspecialchars($task["deadline"]); ?></p>

    <?php if ($task["status"] === Status::AWAITING->value) { ?>
        <a href="/Task/changeStatus/<?= htmlspecialchars($task['id']); ?>" class="button">Mark as completed</a>
    <?php } else { ?>
        <a href="/Task/changeStatus/<?= htmlspecialchars($task['id']); ?>" class="button">Mark as awaiting</a>
    <?php } ?>

    <a href="/Task/update/<?= htmlspecialchars($task['id']); ?>" class="button">Edit</a>

    <form action="/Task/delete/<?= htmlspecialchars($task['id']); ?>" method="post">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
        <button class="button" type="submit" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
    </form>
<?php endforeach ?>
</div>