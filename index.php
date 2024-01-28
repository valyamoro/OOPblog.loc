<?php
declare(strict_types=1);
error_reporting(-1);
session_start();

function dump(mixed $data): void
{
    echo '<pre>';
    print_r($data);
    echo '<pre>';
}

use app\core\Router;

require __DIR__ . '/vendor/autoload.php';

$router = new Router();
$router->resolve();
