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

                $options = $this->getOptions($uriPattern, $uri, $path);

                if (file_exists(ROOT_DIR . '/app/controllers/' . $options['controller'] . '.php')) {
                    $controllerObject = new $options['controller']($options['template'], $options['model']);
                    $controllerObject->$options['action']($options['params']);
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
     * array['template']
     * array['controller']
     * array['action']
     * array['model']
     * array['params'][]
     */
    private function getOptions($pattern, $uri, $path) {
        $route = preg_replace("~^{$pattern}$~", $path, $uri);
        $segments = explode('/', $route);
        $template = 'main';

        if (STATUS == '1') {
            if (isset($_SESSION['access'])) {
                $template = strtolower(array_shift($segments));
                $controller = array_shift($segments);
                $action = array_shift($segments);
            } else {
                $template = 'access';
                $controller = 'site';
                $action = 'access';
            }
        } else {
            $template = strtolower(array_shift($segments));
            $controller = array_shift($segments);
            $action = array_shift($segments);
        }

        return array(
            'template' => $template,
            'controller' => ucfirst($controller) . 'Controller',
            'action' => 'action' . ucfirst($action),
            'model' => ucfirst($controller) . 'Model',
            'params' => $segments
        );
    }
}