<?php

use app\core\ErrorHandler;

function dump(mixed $data): void
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

function displayMessages(string $type): void
{
    echo \nl2br($_SESSION[$type]);
    unset($_SESSION[$type]);
}

register_shutdown_function('handleFatalError');

function handleFatalError(): void
{
    $error = error_get_last();

    if ($error !== null && $error['type'] === E_ERROR) {
        ErrorHandler::handle404();
    }
}
