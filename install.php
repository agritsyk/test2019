<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

define('ROOT', dirname(__FILE__));
require_once (ROOT . '/components/Autoload.php');
spl_autoload_register('myAutoLoader');

Database::getDatabaseConnection()->exec(sprintf('
CREATE TABLE IF NOT EXISTS %s (
  `uid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  PRIMARY KEY (uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;', Database::USER_TABLE));

echo "Таблица успешно создана";
