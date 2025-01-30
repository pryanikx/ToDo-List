<h1>My ToDo List!</h1>
<a href="/Task/create">Добавить задачу</a>
<?= var_dump($tasks); ?>
<?php foreach($tasks as $task): ?>
    <h4>Category: <?= $task["category"]; ?></h4>
    <p><?= $task["description"]; ?></p>
    <p>status: <?= $task["status"]; ?></p>
    <p>created at<?= $task["created_at"]; ?></p>
    <p>deadline <?= $task["deadline"]; ?></p>
    <a href="/Task/update/<?= htmlspecialchars($task['id']); ?>">Редактировать содержимое задачи</a>

    <form action="/Task/delete/<?= htmlspecialchars($task['id']); ?>" method="post" target="hiddenFrame">
    <button type="submit" onclick="return confirm('Вы уверены, что хотите удалить задачу')">Удалить</button>
    </form>
    <iframe name="hiddenFrame" style="display:none;"></iframe>
    <a href="/Task/delete/<?= htmlspecialchars($task['id']); ?>">Удалить</a> 
    

    <!-- // TODO: show results of read function -->
    <!-- // TODO: add ability to change the status of the task -->
<?php endforeach ?>