<?php
declare(strict_types=1);

namespace app\Services\Admins;

use app\Services\BaseService;

class ModerateAdminService extends BaseService
{
    public function getAll(string $page): array
    {
        $result = [];

        if (!empty($_SESSION['user']) && $_SESSION['user']['role'] !== '0') {
            $result['items'] = $this->repository->getAll($page);

            if (empty($result['items'])) {
                $result['warning'] = 'There are not have a ' . $page;
            }
        } else {
            \header('Location: /articles');
        }

        return $result;
    }

}
