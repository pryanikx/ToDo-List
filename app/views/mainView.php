<h1>My ToDo List!</h1>
<a href="/Task/create">Добавить задачу</a>
<?php foreach($tasks as $task): ?>
    <p>Upload date: <?= $article["UploadDate"]; ?></p>
    <p>Deadline: <?= $article["Deadline"]; ?></p>
    <h3><?= $article["Category"]; ?></h3>
    <p><?= $article["Description"]; ?></p>
    <!--
    <a href="/Article/update/<?= htmlspecialchars($article['id']); ?>">Редактировать</a>
    <a href="/Article/delete/<?= htmlspecialchars($article['id']); ?>">Удалить</a> 
    -->
<?php endforeach ?>