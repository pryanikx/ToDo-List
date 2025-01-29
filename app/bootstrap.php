<?php

require_once "config/config.php";
require_once "core/controller.php";
require_once "core/model.php";
require_once "core/view.php";
require_once "core/route.php";
require_once "core/Database.php";

$conn = (Database::getInstance())->getConnection($db_config);

Route::start($conn);