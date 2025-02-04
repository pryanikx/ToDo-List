
<div class="container">
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
    <a href="/Task/changeStatus/<?= htmlspecialchars($task['id']); ?>" class="button">Mark as completed</a>
    <a href="/Task/update/<?= htmlspecialchars($task['id']); ?>" class="button">Edit</a>

    <form action="/Task/delete/<?= htmlspecialchars($task['id']); ?>" method="post">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
        <button class="button" type="submit" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
    </form>
<?php endforeach ?>
</div>

<aside class="filter-panel">
        <h2>Filters and sorts:</h2>
        <form action="/Task/index" method="GET">
            <p><b>Filters:</b></p>
            <label for="time_filter">By the date of creation:</label>
            <select id="time_filter" name="time_filter">
                <option selected disabled value="all">All</option>
                <option value="today">Today</option>
                <option value="this_week">This week</option>
                <option value="this_month">This month</option>
            </select><br>

            <label for="category_filter">Seperate category:</label>
            <select id="category_filter" name="category_filter">
                <option value="all" selected disabled>All</option>
                <?php 
                $uniqueCategories = [];

                foreach ($data as $task):
                    if (!isset($uniqueCategories[$task["name"]])) {
                        $uniqueCategories[$task["name"]] = true;    
                        $textColor = getContrastColor($task['color']); ?>
                        <option value="<?= htmlspecialchars($task['name'])?>"
                        style="background: <?= $task['color'] ?>; color: <?= $textColor ?>;">
                        <?= $task['name'] ?>
                        </option>
                <?php } endforeach; ?>
            </select><br>

            <label for="overdue">Only overdue</label>
            <input type="radio" id="overdue" name="overdue" value="overdue" onclick="toggleRadio(this)" /><br>
                    
            <p><b>Sorts:</b></p>

            <label for="sort">Sort by:</label>
            <select id="sort" name="sort">
                <option value="default" selected disabled>Default</option>
                <option value="created_at">Date of creation</option>
                <option value="deadline">Time to deadline</option>
            </select>

            <label for="ascending_order">Ascending order:</label>
            <input type="radio" id="ascending_order" name="order" value="ASC" onclick="toggleRadio(this)" /><br>

            <label for="descending_order">Descending order:</label>
            <input type="radio" id="descending_order" name="order" value="DESC" onclick="toggleRadio(this)" /><br>
            
            <button type="submit" class="button_filter">Apply</button>
        </form>
    </aside>
    </div>

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