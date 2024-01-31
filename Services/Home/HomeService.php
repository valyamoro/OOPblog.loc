<?php
declare(strict_types=1);

namespace app\Services\Home;

use app\core\Pagination;
use app\Services\BaseService;

class HomeService extends BaseService
{
    public function getAll(array $request, int $itemsPerPage): array
    {
        $totalItems = $this->repository->getCount('articles', 'is_active=1 and is_blocked=0');

        $result['pagination'] = $this->getPaginationObject($request, $itemsPerPage, $totalItems);
        $result['articles_id'] = $this->pagination($result['pagination'], 'articles', 'is_blocked=0 and is_active=1');

        if (empty($result['articles_id'])) {
            $_SESSION['warning'] = 'There are no articles on the site' . "\n";
        } else {
            $result['articles'] = $this->repository->getArticlesByIds($result['articles_id']);
        }

        return $result;
    }

}
