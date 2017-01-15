<?php
session_start();

ini_set('display_errors', 1);
defined('ROOT_DIR') or define('ROOT_DIR', __DIR__);
defined('CONFIG_DIR') or define('CONFIG_DIR', ROOT_DIR . '/app/config/');
defined('SERVER') or define('SERVER', 'nginx'); // 'apache' or 'nginx'
defined('STATUS') or define('STATUS', '0'); // NORMAL: 0; DEV: 1;

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