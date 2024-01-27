<?php
declare(strict_types=1);

namespace app\Services\Home;

use app\core\Paginator;
use app\Services\BaseService;

class HomeService extends BaseService
{
    public function getAll(): array
    {
        $totalItems = $this->repository->getCount();
        $itemsPerPage = 5;
        $currentPage = (int)($_GET['page'] ?? 1);

        $result['paginator'] = new Paginator($totalItems, $itemsPerPage, $currentPage);

        $mode = $_GET['mode'] ?? 'asc';
        $result['paginator']->setOrder($mode);

        $totalPages = $result['paginator']->calculateTotalPages();

        if ($currentPage <= 0) {
            \header("Location: /?page=1&mode={$result['paginator']->getOrder()}");
        }

        if ($currentPage > $totalPages) {
            \header("Location: /?page={$totalPages}&mode={$result['paginator']->getOrder()}");
        }

        $offset = ($currentPage - 1) * $itemsPerPage;

        $result['articles'] = $this->repository->getAll($itemsPerPage, $offset, $mode);
        $result['categories'] = $this->repository->getCategories();

        if (empty($result['articles'])) {
            $_SESSION['warning'] = 'There are no articles on the site' . "\n";
        }

        return $result;
    }

}
