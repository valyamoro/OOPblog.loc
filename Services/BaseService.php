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

    protected function pagination(Pagination $pagination, string $item, string $condition): array
    {
        if ($pagination->getTotalItems() !== 0 && $pagination->getCurrentPage() <= 0) {
            \header("Location: /{$item}?page=1&mode={$pagination->getOrder()}");
        }

        $totalPages = $pagination->calculateTotalPages();
        if ($pagination->getTotalItems() !== 0 && $pagination->getCurrentPage() > $totalPages) {
            \header("Location: /{$item}?page={$totalPages}&mode={$pagination->getOrder()}");
        }

        return $this->repository->getAll($pagination->getItemsPerPage(), $pagination->getOffset(), $pagination->getOrder(), $item, $condition);
    }

    public function getPaginationObject(array $request, int $itemsPerPage, int $totalItems): Pagination
    {
        $currentPage = (int)($request['page'] ?? 1);

        $mode = $request['mode'] ?? 'asc';
        $result = new Pagination($totalItems, $itemsPerPage, $currentPage);
        $result->setOrder($mode);

        return $result;
    }

}
