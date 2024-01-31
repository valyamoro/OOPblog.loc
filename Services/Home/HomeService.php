<?php
declare(strict_types=1);

namespace app\Services\Home;

use app\core\Pagination;
use app\Services\BaseService;

class HomeService extends BaseService
{
    public function getAll(array $request, int $itemsPerPage): array
    {
        $totalItems = $this->repository->getCount('articles');
        $result['pagination'] = $this->getPaginationObject($request, $itemsPerPage, $totalItems);
        $result['articles'] = $this->pagination($result['pagination'], 'articles', 'is_active=1');

        if (empty($result['articles'])) {
            $_SESSION['warning'] = 'There are no articles on the site' . "\n";
        }

        return $result;
    }

}
