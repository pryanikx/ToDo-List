<div class="content">
<?php foreach ($data as $task): ?>
    <h3>
        <span class="task-circle" style="background-color: <?= htmlspecialchars($task['color']); ?>;"></span>
        <?= htmlspecialchars($task["name"]); ?>
    </h3>

    <p class="task-info">
        <span class="task-label">Description:</span> 
        <span class="task-value"><?= htmlspecialchars($task["description"]); ?></span>
    </p>

    <p class="task-info">
        <span class="task-label">Status:</span>
        <span class="task-status status-completed"><?= htmlspecialchars($task["status"]); ?></span>
    </p>

    <p class="task-info">
        <span class="task-label">Date of creation:</span> 
        <span class="task-value"><?= htmlspecialchars($task["created_at"]); ?></span>
    </p>

    <p class="task-info">
        <span class="task-label">date of completion:</span> 
        <span class="task-value"><?= htmlspecialchars($task["completed_at"]); ?></span>
    </p>

    <p class="task-info">
        <span class="task-label">Deadline:</span> 
        <span class="task-value"><?= htmlspecialchars($task["deadline"]); ?></span>
    </p>

    <a href="/Task/changeStatus/<?= htmlspecialchars($task['id']); ?>" class="button button-awaiting">Mark as awaiting</a>

    <form action="/Task/delete/<?= htmlspecialchars($task['id']); ?>" method="post">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
        <button class="button button-delete" type="submit" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
    </form>
<?php endforeach; ?>
</div>
