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
            $totalItems = $this->repository->getCount($page, 'is_active=0');

            $result['pagination'] = $this->getPaginationObject($request, $itemsPerPage, $totalItems);
            $result['items_id'] = $this->pagination($result['pagination'], $page, 'is_active=0');

            if (empty($result['items_id'])) {
                $result['warning'] = 'There are not have a ' . $page;
            } else {
                $result['items'] = $this->repository->getItemsByIds($page, $result['items_id']);
            }


        } else {
            \header('Location: /articles');
        }

        return $result;
    }

}
