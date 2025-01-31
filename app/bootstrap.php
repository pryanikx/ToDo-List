<?php

require_once "config/config.php";
require_once "core/controller.php";
require_once "core/ATask.php";
require_once "core/ACategory.php";
require_once "core/view.php";
require_once "core/route.php";
require_once "core/Database.php";
require_once "enums/status.php";

$conn = (Database::getInstance())->getConnection($db_config);

Route::start($conn);