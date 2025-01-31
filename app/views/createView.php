<form action="" method="post">
    <label for="categories">Choose a category:</label>

    <select name="categories" id="categories">
        <?php foreach ($data as $category): ?>
            <option value="<?= $category['id']?>"<?=$category['name']?></option>
        <?php endforeach; ?>
    </select><br>
    
    <button type="button" id="addCategoryBtn">Добавить категорию</button>
    <input type="text" name="new_category" id="newCategoryInput" placeholder="Новая категория" style="display: none;">
    <textarea id="text" name="description" value="text" rows="10" cols="30" required>Description of the task</textarea><br>
    <input type="datetime-local" name="deadline"><br>
    <input type="submit" name="add" value="Добавить статью">
</form>
<footer>
    <p>&copy; <?= date('Y') ?> pernikkov</p>
</footer>

<script>
    // Показать поле ввода новой категории при нажатии на "+"
    document.getElementById("addCategoryBtn").addEventListener("click", function() {
        var input = document.getElementById("newCategoryInput");
        input.style.display = "block";
        input.focus();
    });
</script>