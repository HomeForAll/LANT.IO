<?php
session_start();

function __autoload($className) {

    $pathsArray = array(
        '/app/core/',
        '/app/controllers/',
        '/app/models/',
        '/app/modules/' . $className
    );

    foreach ($pathsArray as $path){
        $path = ROOT_DIR . $path . $className . '.php';

        if (is_file($path)) {
            require_once $path;
        }
    }
}

$router = new Router();
$router->run();