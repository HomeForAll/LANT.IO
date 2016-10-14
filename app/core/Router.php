<?php

class Router
{
    private $routes;
    private $title;
    private $controller;
    private $action;

    public function __construct($page = null)
    {
        $routesPath = ROOT_DIR . '/app/config/routes.php';
        $this->routes = require $routesPath;
        $this->page = $page;
    }

    /**
     * Метод проверяет наличие строки запроса в таблице маршрутизации routes.php,
     * если присутствует, определяет контроллер и передает ему управление,
     * при наличии параметров в строке запроса, передает их action в виде массива.
     */
    public function run()
    {
        $uri = $this->getURI();
        foreach ($this->routes as $uriPattern => $path) {
            if (preg_match("~^{$uriPattern}$~", $uri)) {

                $options = $this->getOptions($uriPattern, $uri, $path);

                if (file_exists(ROOT_DIR . '/app/controllers/' . $options['controllerName'] . '.php')) {
                    $controllerObject = new $options['controllerName']($options['pageName'], $options['viewName'], $options['modelName']);
                    $controllerObject->$options['actionName']($options['params']);
                }
            }
        }
    }

    /**
     * Возвращает URI или false, если строка запроса пустая
     *
     * @return bool|string
     */
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            $url = parse_url(urldecode($_SERVER['REQUEST_URI']), PHP_URL_PATH);
            if (SERVER == 'nginx') {
                return trim(str_replace('index.php', '', trim($url, '/')), '/');
            } elseif (SERVER == 'apache') {
                return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
            }
        }
        return false;
    }

    /*
     * Возвращает массив с такими параметрами:
     * array['controllerName']
     * array['actionName']
     * array['viewName']
     * array['modelName']
     * array['params'][]
     */
    private function getOptions($pattern, $uri, $path)
    {
        $route = preg_replace("~^{$pattern}$~", $path, $uri);
        $segments = explode('/', $route);

        if (STATUS == '1')
        {
            if (isset($_SESSION['access'])) {
                $pageName = array_shift($segments);
                $controller = array_shift($segments);
                $action = array_shift($segments);
            } else {
                $pageName = 'Проверка доступа';
                $controller = 'site';
                $action = 'access';
            }
        } else {
            $pageName = array_shift($segments);
            $controller = array_shift($segments);
            $action = array_shift($segments);
        }

        return array(
            'pageName' => $pageName,
            'controllerName' => ucfirst($controller) . 'Controller',
            'actionName' => 'action' . ucfirst($action),
            'viewName' => strtolower($action),
            'modelName' => ucfirst($controller) . 'Model',
            'params' => $segments
        );
    }

    private function getAccess()
    {

    }
}