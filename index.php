<?php
session_start();

ini_set('display_errors', 1);
defined('ROOT_DIR') or define('ROOT_DIR', dirname(__FILE__));
defined('CONFIG_DIR') or define('CONFIG_DIR', ROOT_DIR . '/app/config/');
defined('SERVER') or define('SERVER', 'nginx'); // 'apache' or 'nginx'
defined('STATUS') or define('STATUS', '1'); // NORMAL: 0; DEV: 1;

require_once ROOT_DIR . '/app/core/Loader.php';

spl_autoload_register(array('Loader', 'classLoad'));

Loader::getPathsFromFile();
(new Router())->run();