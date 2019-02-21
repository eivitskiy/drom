<?php

use core\App;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

define('ROOT_PATH', __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
define("APP_PATH", ROOT_PATH . 'application' . DIRECTORY_SEPARATOR);

require_once __DIR__ . '/../vendor/autoload.php';

App::init();