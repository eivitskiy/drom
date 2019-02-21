<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

define("ROOT_PATH", $_SERVER['DOCUMENT_ROOT'] . '/..');
define("APP_PATH", ROOT_PATH . '/application');

require_once __DIR__ . '/../vendor/autoload.php';

phpinfo();