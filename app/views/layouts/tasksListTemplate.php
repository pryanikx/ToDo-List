<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="/">
    <link rel="stylesheet" href="/public/css/tasksList.css?v=<?= time(); ?>">

    <title>ToDo-List</title>
</head>
<body>
    <?php 
        require_once "app/views/layouts/header.php";
        require_once "app/views/" . $contentView;
        require_once "app/views/layouts/footer.php";
    ?>
</body>
</html>