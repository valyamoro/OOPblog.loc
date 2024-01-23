<?php
declare(strict_types=1);

namespace app\Database;

interface DatabaseConnection
{
    public function connection();
}