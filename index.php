<?php
declare(strict_types=1);
error_reporting(-1);
session_start();

use app\core\ErrorHandler;
use app\core\Router;

require __DIR__ . '/helpers/helpers.php';
require __DIR__ . '/vendor/autoload.php';


try {
    $router = new Router();
    $router->resolve();
} catch (Error $e) {
    if ($e->getCode() === 404) {
        ErrorHandler::handle404();
    }

}