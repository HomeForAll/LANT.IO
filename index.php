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

/**
 * geolocation
 */
Registry::set('location', new \IP2Location\Database(ROOT_DIR . '/app/config/IP2LOCATION-LITE-DB5.BIN', \IP2Location\Database::FILE_IO));

use GeoIp2\Database\Reader;

$reader = new Reader(ROOT_DIR . '/app/config/GeoLite2-City.mmdb');;
$record = $reader->city('134.249.129.113');

print($record->country->isoCode . "\n"); // 'US'
print($record->country->names['ru'] . "\n");

print($record->mostSpecificSubdivision->name . "\n"); // 'Minnesota'
print($record->mostSpecificSubdivision->isoCode . "\n"); // 'MN'

print($record->city->name . "\n"); // 'Minneapolis'

print($record->postal->code . "\n"); // '55455'

print($record->location->latitude . "\n"); // 44.9733
print($record->location->longitude . "\n"); // -93.2323
/*
 * ****/

(new Router())->run();