<?php
// Функция для вычисления контрастного цвета текста
function getContrastColor($hex) {
    $hex = ltrim($hex, '#');
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));
    $luminance = (0.2126 * $r + 0.7152 * $g + 0.0722 * $b) / 255;
    return ($luminance > 0.5) ? '#000000' : '#FFFFFF';
}
?>

<form action="" method="post">
    <label for="categories">Choose a category:</label>

    <select name="category" id="categories">
        <option value="" selected disabled>category</option>
        <?php foreach ($data as $category): 
            $textColor = getContrastColor($category['color']); ?>
            <option value="<?= $category['id']?>"
                style="background: <?= $category['color'] ?>; color: <?= $textColor ?>;">
                <?= $category['name'] ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    <button class="button" type="button" id="addCategoryBtn">Add category</button>
    
    <div id="newCategoryContainer" style="display: none;">
        <input type="text" name="new_category" id="newCategoryInput" placeholder="New category">
        <input type="color" name="new_category_color" id="newCategoryColor" value="#ff0000">
    </div>

    <textarea name="description" rows="10" cols="30" placeholder="Description of the task" required></textarea><br>
    <input type="datetime-local" name="deadline" min="<?php echo date('Y-m-d\TH:i'); ?>" required /><br>
    
    <input type="submit" name="add" value="Create task">
</form>

<footer>
    <p>&copy; <?= date('Y') ?> pernikkov</p>
</footer>

<script>
    document.getElementById("addCategoryBtn").addEventListener("click", function() {
        var container = document.getElementById("newCategoryContainer");
        container.style.display = "block";
        document.getElementById("newCategoryInput").focus();
    });
</script>
