<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

// 2. Подключение файлов системы
define('ROOT', dirname(__FILE__));
require_once (ROOT . '/components/Autoload.php');
spl_autoload_register('myAutoLoader');

$router = new Router();
$router->run();
