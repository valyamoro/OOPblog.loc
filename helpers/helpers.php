<?php

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

function handleFatalError(): void
{
    $error = error_get_last();

    if (!empty($error) && $error['type'] === E_ERROR) {
        \header('Location: /errors/_404');
        exit;
    }

}

\register_shutdown_function('handleFatalError');
