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

Loader::getPaths();
Registry::set('config', require ROOT_DIR . '/app/config/config.php');
Registry::set('routes', require ROOT_DIR . '/app/config/routes.php');

//$db = new \IP2Location\Database('./databases/IP-COUNTRY-SAMPLE.BIN', \IP2Location\Database::FILE_IO);

(new Router())->run();