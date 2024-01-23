<?php
declare(strict_types=1);

namespace app\Services;
use app\Database\PDODriver;

abstract class BaseRepository
{
    protected const TABLE_NAME = '';

    public function __construct(
        protected PDODriver $connection,
    ) {
    }

}
