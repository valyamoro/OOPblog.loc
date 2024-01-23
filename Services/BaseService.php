<?php
declare(strict_types=1);

namespace app\Services;

abstract class BaseService
{
    public function __construct(
        protected BaseRepository $repository,
    ) {
    }

}
