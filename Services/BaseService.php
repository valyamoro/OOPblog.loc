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

    protected function pagination(
        Pagination $pagination,
        string $item,
        string $condition,
        string $method = 'getAllIds',
        array $params = [],
    ): array {
        $currentUrl = $_SERVER['REQUEST_URI'];
        $numberPosition = \strpos($currentUrl, '&mode') - 1;
        $rightSideUrl = \substr($currentUrl, $numberPosition);
        $numberPage = $rightSideUrl[0];

        if ($pagination->getTotalItems() !== 0 && $pagination->getCurrentPage() <= 0) {
            $currentUrl[$numberPosition] = $numberPage + 1;
            \header("Location: {$currentUrl}");
        }

        $totalPages = $pagination->calculateTotalPages();
        if ($pagination->getTotalItems() !== 0 && $pagination->getCurrentPage() > $totalPages) {
            $currentUrl[$numberPosition] = $numberPage - 1;
            \header("Location: {$currentUrl}");
        }

        return $this->repository->$method($pagination->getItemsPerPage(), $pagination->getOffset(),
            $pagination->getOrder(), $item, $condition, $params);
    }

    public function getPaginationObject(array $request, int $itemsPerPage, int $totalItems): Pagination
    {
        $currentPage = (int)($request['page'] ?? 1);

        $mode = $request['mode'] ?? 'asc';
        $result = new Pagination($totalItems, $itemsPerPage, $currentPage, $request);
        $result->setOrder($mode);

        return $result;
    }


}
