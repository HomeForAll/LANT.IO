<?php

chmod(__DIR__ . '/app/config', 0777);
chmod(__DIR__ . '/app/core/Loader.php', 0777);

$output = `cd /`;
$composer_inst = `composer install`;

echo 'Установка завершена!';

print_r($composer_inst);