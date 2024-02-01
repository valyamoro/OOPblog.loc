<?php
declare(strict_types=1);
error_reporting(-1);
session_start();

use app\core\Router;

require __DIR__ . '/helpers/helpers.php';
require __DIR__ . '/vendor/autoload.php';


$router = new Router();
$router->resolve();
