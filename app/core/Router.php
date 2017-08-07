<?php

class Router
{
    private $routes;
    
    public function __construct()
    {
        $this->routes = require ROOT_DIR . 'app' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'routes.php';
    }
    
    /**
     * Метод проверяет наличие строки запроса в таблице маршрутизации routes.php,
     * при наличии, определяет контроллер и передает ему управление.
     */
    public function run()
    {
        //Обработчик ошибок
        if (ERROR_HANDLER_STATUS != '0') {
            (new ErrorHandler())->register();
        }
        $uri = $this->getURI();
        foreach ($this->routes as $uriPattern => $path) {
			var_dump($uriPattern);
            if (preg_match("~^{$uriPattern}$~", $uri, $m)) {
                $options = $this->getOptions($uriPattern, $uri, $path);
                $action  = $options['action'];
                
                if (file_exists(ROOT_DIR . '/app/controllers/' . $options['controller'] . '.php')) {
                    $controllerObject = new $options['controller']($options['template']);
                    $controllerObject->$action($options['params']);
                }
				break;
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
            $url = trim(array_shift(explode('?', urldecode($_SERVER['REQUEST_URI']))), '/');
            if (SERVER == 'nginx') {
                return trim(str_replace('index.php', '', $url), '/');
            } elseif (SERVER == 'apache') {
                return $url;
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
    private function getOptions($pattern, $uri, $path)
    {
        $route    = preg_replace("~^{$pattern}$~", $path, $uri);
        $segments = explode('/', $route);
        
        if (STATUS == '1') {
            $db   = new DataBase();
            $stmt = $db->prepare("SELECT * FROM access WHERE key = :key");
            $stmt->bindParam(':key', $_SESSION['key']);
            $stmt->execute();
            $result = $stmt->fetch();
            
            if (isset($_SESSION['access'])) {
                if ($result['status'] == 1) {
                    $template   = array_shift($segments);
                    $controller = array_shift($segments);
                    $action     = array_shift($segments);
                } else {
                    unset($_SESSION['access']);
                    unset($_SESSION['key']);
                    $template   = 'access';
                    $controller = 'site';
                    $action     = 'access';
                }
            } else {
                $template   = 'access';
                $controller = 'site';
                $action     = 'access';
            }
        } else {
            $template   = strtolower(array_shift($segments));
            $controller = array_shift($segments);
            $action     = array_shift($segments);
        }
        
        return [
            'template'   => $template,
            'controller' => ucfirst($controller) . 'Controller',
            'action'     => 'action' . ucfirst($action),
            'params'     => $segments,
        ];
    }
}