<?php
declare(strict_types=1);

namespace app\Services;

use app\core\Pagination;

abstract class BaseService
{
    public function __construct(
        protected BaseRepository $repository,
    ) {
    }

    protected function pagination(array $request, int $itemsPerPage, string $item): array
    {
        $totalItems = $this->repository->getCount('articles');
        $currentPage = (int)($request['page'] ?? 1);

        $result['paginator'] = new Pagination($totalItems, $itemsPerPage, $currentPage);

        $mode = $request['mode'] ?? 'asc';
        $result['paginator']->setOrder($mode);
        if ($totalItems !== 0 && $currentPage <= 0) {
            \header("Location: /articles?page=1&mode={$result['paginator']->getOrder()}");
        }

        $totalPages = $result['paginator']->calculateTotalPages();
        if ($totalItems !== 0 && $currentPage > $totalPages) {
            \header("Location: /articles?page={$totalPages}&mode={$result['paginator']->getOrder()}");
        }

        $result[$item] = $this->repository->getAll($itemsPerPage, $result['paginator']->getOffset(), $mode, $item);

        return $result;
    }

}
