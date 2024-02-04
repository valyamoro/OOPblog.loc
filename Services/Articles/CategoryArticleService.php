<?php
declare(strict_types=1);

namespace app\Services\Articles;

use app\core\Http\Request;
use app\Services\BaseService;

class CategoryArticleService extends BaseService
{
    public function getCategoryArticles(Request $request, int $itemsPerPage): array
    {
        $result['articles'] = [];

        $id = $this->repository->getIdByCategory($request->getCategory());
        if (empty($id)) {
            $_SESSION['message'] = 'This category doesnt exist!' . "\n";
        } else {
            $ids = $id . ',' . \rtrim($this->repository->getCategoriesIds($this->repository->getAllCategories(), $id), ',');
            $totalItems = $this->repository->getCountArticlesByIdCategory($ids);

            $params = $request->getGET();
            $mode = $params['mode'] ?? 'asc';
            $result['pagination'] = $this->getPaginationObject($params, $itemsPerPage, $totalItems, $mode);
            $result['articles'] = $this->pagination($result['pagination'], 'articles', 'is_active=1', 'getArticles', [$ids]);
            if (empty($result['articles'])) {
                $_SESSION['message'] = 'Articles with this category doesnt exist!' . "\n";
            }
        }

        return $result;
    }

}
