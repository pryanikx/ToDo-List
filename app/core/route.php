<?php

class Route {

    static function start($conn) {
        $controllerName = 'Task';
        $actionName = 'index';

    $routes = explode('/', $_SERVER['REQUEST_URI']);

    if (!empty($routes[1])) {
        $controllerName = $routes[1];
    }

    if (!empty($routes[2])) {
        $actionName = $routes[2];
    }

    $id = !empty($routes[3]) ? $routes[3] : null; 

    $modelName = $controllerName;
    $controllerName = $controllerName . "Controller";

    $modelFile = strtolower($modelName) . '.php';
    $modelPath = "app/models/" . $modelFile;

    if (file_exists($modelPath)) {
        require $modelPath;
    }

    $controllerFile = strtolower($controllerName) . '.php';
    $controllerPath = "app/controllers/" . $controllerFile;

    if (file_exists($controllerPath)) {
        require $controllerPath;
    } else {
        self::ErrorPage404();
    }

    $controller = new $controllerName($conn);

    if (method_exists($controller, $actionName)) {
        // обработка случая с id != null
        $controller->$actionName();
    } else {
        self::ErrorPage404();
    }
}

    static function ErrorPage404() {
        $host = "http://" . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header('Status : 404 Not Found');
        header('Location:' . $host . '404');
        exit();
    }
}