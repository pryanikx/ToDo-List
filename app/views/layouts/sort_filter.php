<?php
function getContrastColor($hex) {
    $hex = ltrim($hex, '#');
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));
    $luminance = (0.2126 * $r + 0.7152 * $g + 0.0722 * $b) / 255;
    return ($luminance > 0.5) ? '#000000' : '#FFFFFF';
}
?>

<aside class="filter-panel">
        <h2>Фильтрация и сортировка</h2>
        <form action="/Task/index" method="GET">
            <p><b>Фильтры:</b></p>
            <label for="time_filter">По времени добавления:</label>
            <select id="time_filter" name="time_filter">
                <option selecte = "selected" value="all">Все</option>
                <option value="today">Сегодня</option>
                <option value="this_week">На этой неделе</option>
                <option value="this_month">В этом месяце</option>
            </select><br>

            <label for="category_filter">Отдельная категория:</label>
            <select id="category_filter" name="category_filter">
                <option selected = "selected" value="all">Все</option>
                <?php 
                $uniqueCategories = [];

                foreach ($data as $task):
                    if (!isset($uniqueCategories[$task["name"]])) {
                        $uniqueCategories[$task["name"]] = true;    
                    $textColor = getContrastColor($task['color']); ?>
                    <option value="<?= $task['name']?>"
                    style="background: <?= $task['color'] ?>; color: <?= $textColor ?>;">
                    <?= $task['name'] ?>
                    </option>
                <?php } endforeach; ?>
            </select><br>

            <label for="after_deadline">Только просроченные</label>
            <input type="radio" id="after_deadline" name="after_deadline" value="after_deadline" onclick="toggleRadio(this)" /><br>
                    
            <p><b>Сортировки:</b></p>

            <label for="sort">Сортировка по:</label>
            <select id="sort" name="sort">
                <option selected="selected" value="default">Default</option>
                <option value="created_at_cort">Дате создания</option>
                <option value="deadline_sort">Времени до дедлайна</option>
            </select>

            <label for="ascending_order">В порядке возрастания:</label>
            <input type="radio" id="ascending_order" name="order" value="ascending_order" onclick="toggleRadio(this)" /><br>

            <label for="descending_order">В порядке убывания:</label>
            <input type="radio" id="descending_order" name="order" value="descending_order" onclick="toggleRadio(this)" /><br>
            
            <button type="submit" class="button_filter">Применить</button>
        </form>
    </aside>

<script>
let lastCheckedRadio = null;

function toggleRadio(radio) {
    if (lastCheckedRadio === radio) {
        radio.checked = false;
        lastCheckedRadio = null;
    } else {
        lastCheckedRadio = radio;
    }
}
</script>