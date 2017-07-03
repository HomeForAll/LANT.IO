<?php
session_set_cookie_params(604800);
session_start();

ini_set('display_errors', 0);
defined('ROOT_DIR') or define('ROOT_DIR', __DIR__);
defined('CONFIG_DIR') or define('CONFIG_DIR', ROOT_DIR . '/app/config/');
defined('SERVER') or define('SERVER', 'nginx'); // 'apache' or 'nginx'
defined('STATUS') or define('STATUS', '1'); // NORMAL: 0; DEV: 1;
defined('ERROR_HANDLER_STATUS') or define('ERROR_HANDLER_STATUS', '2'); // не применять: 0; запись в error.log: 1; вывод на экран: 2

require_once __DIR__ . '/app/core/Loader.php';
require_once __DIR__ . '/vendor/autoload.php';

Loader::getPaths(); // загружаем карту классов из файла

spl_autoload_register(
    [
        'Loader',
        'classLoad',
    ]
);

$redis = new Predis\Client();

Registry::set('redis', $redis);

if (!$redis->exists('config')) {
    $config = serialize(require ROOT_DIR . '/app/config/config.php');
    $redis->set('config', $config);
    $redis->expire('config', 30);
}

if (!$redis->exists('routes')) {
    $routes = serialize(require ROOT_DIR . '/app/config/routes.php');
    $redis->set('routes', $routes);
    $redis->expire('routes', 30);
}

(new Router())->run();