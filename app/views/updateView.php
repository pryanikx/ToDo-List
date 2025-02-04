
<form action="" method="post">
    <label for="categories">Category:</label>

    <select name="category" id="categories">
        <option value="" selected disabled>choose a category</option>
        <?php foreach ($data["categories"] as $category):
            $textColor = getContrastColor($category['color']); ?>
            <option value="<?= $category["id"]; ?>"
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

    <textarea name="description" rows="10" cols="30" placeholder="Description of the task" required><?= $data["task"]["description"] ?></textarea><br>
    <input type="datetime-local" name="deadline" value="<?= $data['task']['deadline'] ?>" min="<?php echo date('Y-m-d\TH:i'); ?>" required /><br>
    
    <input type="submit" name="add" value="Update task">
</form>