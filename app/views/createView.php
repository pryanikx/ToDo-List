<form action="" method="post">
    <input type="text" name="category" value="Category" required><br>
    <textarea id="text" name="description" value="text" rows="10" cols="30" required>Description of the task</textarea><br>
    <input type="datetime-local" name="deadline"><br>
    <input type="submit" name="add" value="Добавить статью">
</form>
<footer>
    <p>&copy; <?= date('Y') ?> pernikkov</p>
</footer>