<?php
declare(strict_types=1);

namespace app\Services\Admins;

use app\Services\BaseService;

class ModerateAdminService extends BaseService
{
    public function getAll(array $request, int $itemsPerPage): array
    {
        $result = [];

        if (!empty($_SESSION['user']) && $_SESSION['user']['role'] !== '0') {
            $page = $request['item'];
            $totalItems = $this->repository->getCount($page);
            $result['pagination'] = $this->getPaginationObject($request, $itemsPerPage, $totalItems);
            $result['items'] = $this->pagination($result['pagination'], 'articles', 'is_active=0');

            if (empty($result['items'])) {
                $result['warning'] = 'There are not have a ' . $page;
            }
        } else {
            \header('Location: /articles');
        }

        return $result;
    }

}
