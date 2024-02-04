<?php
declare(strict_types=1);

namespace app\core;

class ErrorHandler
{
    public static function handle404(): void
    {
        \header('Location: /errors/_404');
    }

}
