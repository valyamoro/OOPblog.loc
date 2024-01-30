<?php
declare(strict_types=1);

namespace app\Services\Home;

use app\core\Pagination;
use app\Services\BaseService;

class HomeService extends BaseService
{
    public function getAll(array $request, int $itemsPerPage): array
    {
        $totalItems = $this->repository->getCount();
        $currentPage = (int)($request['page'] ?? 1);
        $result['paginator'] = new Pagination($totalItems, $itemsPerPage, $currentPage);

        $mode = $request['mode'] ?? 'asc';
        $result['paginator']->setOrder($mode);
        if ($currentPage <= 0) {
            \header("Location: /articles?page=1&mode={$result['paginator']->getOrder()}");
        }

        $totalPages = $result['paginator']->calculateTotalPages();
        if ($currentPage > $totalPages) {
            \header("Location: /articles?page={$totalPages}&mode={$result['paginator']->getOrder()}");
        }

        $result['articles'] = $this->repository->getAll($itemsPerPage, $result['paginator']->getOffset(), $mode);

        if (empty($result['articles'])) {
            $_SESSION['warning'] = 'There are no articles on the site' . "\n";
        }

        return $result;
    }

}
