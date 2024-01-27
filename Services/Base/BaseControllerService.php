<?php
declare(strict_types=1);

namespace app\Services\Base;

use app\Services\BaseService;

class BaseControllerService extends BaseService
{
    public function getAllCategories(): array
    {
        return $this->repository->getAll();
    }

}
