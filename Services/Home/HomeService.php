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
        $currentPage = (int)$_GET['page'] ?? 1;
        $itemsPerPage = 5;

        $result['paginator'] = new Paginator($totalItems, $itemsPerPage, $currentPage);

        if ($currentPage <= 0) {
            \header('Location: /?page=1');
        }

        $totalPages = $result['paginator']->calculateTotalPages();
        if ($currentPage > $totalPages) {
            \header("Location: /?page={$totalPages}");
        }

        $offset = ($currentPage - 1) * $itemsPerPage;
        $result['articles'] = $this->repository->getAll($itemsPerPage, $offset);

        if (empty($result['articles'])) {
            $_SESSION['warning'] = 'There are no articles on the site' . "\n";
        }

        return $result;
    }

}
