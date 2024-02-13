<?php
declare(strict_types=1);
error_reporting(-1);
session_start();

use app\core\Http\Request;
use app\core\Router;

require __DIR__ . '/vendor/autoload.php';


$router = new Router();

$request = new Request();

try {
    echo $router->dispatch($request);
} catch (\Throwable $e) {
    echo $e->getMessage();
    \header('Location: /errors/_404');
}
