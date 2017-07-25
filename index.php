<?php
session_set_cookie_params(604800);
session_start();

ini_set('display_errors', 0);
ini_set("memory_limit", "300M");
define('DS', DIRECTORY_SEPARATOR);
defined('ROOT_DIR') or define('ROOT_DIR', __DIR__ . DIRECTORY_SEPARATOR);
defined('CONFIG_DIR') or define('CONFIG_DIR', ROOT_DIR . 'app' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR);
defined('SERVER') or define('SERVER', 'nginx'); // 'apache' or 'nginx'
defined('STATUS') or define('STATUS', '0'); // NORMAL: 0; DEV: 1;
defined('ERROR_HANDLER_STATUS') or define('ERROR_HANDLER_STATUS', '1'); // не применять: 0; запись в error.log: 1; вывод на экран: 2

date_default_timezone_set('Europe/Moscow');

require_once ROOT_DIR . 'app' . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'Loader.php';
require_once ROOT_DIR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

Loader::getPaths(); // загружаем карту классов из файла

spl_autoload_register(
    [
        'Loader',
        'classLoad',
    ]
);

Registry::set('config', require ROOT_DIR . 'app' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php');

(new Router())->run();