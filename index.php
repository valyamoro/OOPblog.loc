<?php
declare(strict_types=1);
error_reporting(-1);
session_start();

use app\core\ErrorHandler;
use app\core\Http\Request;
use app\core\Router;

require __DIR__ . '/helpers/helpers.php';
require __DIR__ . '/vendor/autoload.php';

$request = new Request();

try {
    $router = new Router();
    echo $router->dispatch($request);
} catch (Error $e) {
    echo $e->getMessage() . '<br>' . $e->getFile() . '<br>' . $e->getLine();
    ErrorHandler::handle404();
}
