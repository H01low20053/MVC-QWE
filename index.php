<?php
session_start();

use app\core\Router;

require 'autoload.php';
$route = new Router();
$route->run();

ini_set('display_errors', 1);
error_reporting(E_ALL);