<?php

namespace app\Services\Admins;

use app\Services\BaseService;

class ModerateAdminService extends BaseService
{
    public function getAll(string $page): array
    {
        $result['items'] = $this->repository->getAll($page);

        if (empty($result)) {
            $result['messages'] = 'There are not have a ' . $page;
        }

        return $result;
    }
}