<?php

class Router {
    private $routes;

    public function __construct() {
        $routesPath = ROOT_DIR . '/app/config/routes.php';
        $this->routes = require $routesPath;
    }

    /**
     * Метод проверяет наличие строки запроса в таблице маршрутизации routes.php,
     * при наличии, определяет контроллер и передает ему управление.
     */
    public function run() {
        $uri = $this->getURI();
        
        foreach ($this->routes as $uriPattern => $path) {
            if (preg_match("~^{$uriPattern}$~", $uri)) {
                $segments = explode('/', $path);

                $firstArraySegment = ucfirst(array_shift($segments));
                $secondSegment = strtolower(array_shift($segments));

                $controllerName = $firstArraySegment . 'Controller';
                $actionName = 'action' . ucfirst($secondSegment);
                $pageName = ucfirst(array_shift($segments));
                $modelName = $firstArraySegment . 'Model';

                $controllerFile = ROOT_DIR . '/app/controllers/' . $controllerName . '.php';

                if (file_exists($controllerFile)) {
                    $controllerObject = new $controllerName($pageName, $secondSegment, $modelName); // $secondSegment - ViewName
                    $controllerObject->$actionName($uri);
                }
            }
        }
    }

    /**
     * Возвращает URI или false, если строка запроса пустая
     *
     * @return bool|string
     */
    private function getURI() {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
        return false;
    }
}