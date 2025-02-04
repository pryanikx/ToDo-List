<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/tasksList.css">
    <title>ToDo-List</title>
</head>
<body>
<?php 
        require_once "header.php";
        require_once "app/views/" . $contentView;
        require_once "sort_filter.php";
        require_once "footer.php";
    ?>
</body>
</html>