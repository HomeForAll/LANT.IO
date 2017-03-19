<?php
session_start();

ini_set('display_errors', 0);
defined('ROOT_DIR') or define('ROOT_DIR', __DIR__);
defined('CONFIG_DIR') or define('CONFIG_DIR', ROOT_DIR . '/app/config/');
defined('SERVER') or define('SERVER', 'nginx'); // 'apache' or 'nginx'
defined('STATUS') or define('STATUS', '1'); // NORMAL: 0; DEV: 1;
defined('ERROR_HANDLER_STATUS') or define('ERROR_HANDLER_STATUS', '2'); // не применять: 0; запись в error.log: 1; вывод на экран: 2

require_once __DIR__ . '/app/core/Loader.php';
require_once __DIR__ . '/vendor/autoload.php';

spl_autoload_register(array(
    'Loader',
    'classLoad',
));

//$_SESSION['authorized'] = true;
//$_SESSION['userID'] = 3;
//$_SESSION['status'] = 100;

Loader::getPaths();
(new Router())->run();