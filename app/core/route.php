<?php

class Route {
    static function start($conn) {
        $controllerName = 'Task';
        $actionName = 'index';

        // Очистка URL от GET-параметров
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $routes = explode('/', trim($uri, '/'));

        if (!empty($routes[0])) {
            $controllerName = $routes[0];
        }

        if (!empty($routes[1])) {
            $actionName = explode('?', $routes[1])[0]; // Убираем GET-параметры
        }

        $id = !empty($routes[2]) ? $routes[2] : null; 

        $modelName = $controllerName;
        $controllerName = $controllerName . "Controller";

        $modelFile = "app/models/" . strtolower($modelName) . ".php";
        $controllerFile = "app/controllers/" . strtolower($controllerName) . ".php";

        if (file_exists($modelFile)) {
            include $modelFile;
        }

        if (file_exists($controllerFile)) {
            include $controllerFile;
            if (!class_exists($controllerName)) {
                self::ErrorPage404();
            }
        } else {
            self::ErrorPage404();
        }

        $controller = new $controllerName($conn);

        if (is_callable([$controller, $actionName])) {
            if ($id !== null) {
                $controller->$actionName($id);
            } else {
                $controller->$actionName();
            }
        } else {
            self::ErrorPage404();
        }
    }

    static function ErrorPage404() {
        header('HTTP/1.1 404 Not Found');
        header('Location: /404');
        exit();
    }
}
