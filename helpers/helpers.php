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
