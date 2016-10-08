<?php
session_start();

ini_set('display_errors', 1);
defined('ROOT_DIR') or define("ROOT_DIR", dirname(__FILE__));
defined('CONFIG_DIR') or define("CONFIG_DIR", ROOT_DIR . '/app/config/');

require_once ROOT_DIR . '/app/core/Loader.php';

Loader::getPathsFromFile();
spl_autoload_register(array('Loader', 'classLoad'));

(new Router())->run();