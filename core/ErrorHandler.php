<?php
declare(strict_types=1);

namespace app\core;

class ErrorHandler
{
    public static function handle404(): never
    {
        header("HTTP/1.0 404 Not Found");
        \header('Location: /errors/_404');
        exit();
    }

}
