<?php
declare(strict_types=1);

namespace app\Services\Article;

use app\core\Http\Request;
use app\Services\BaseService;

class CategoryArticleService extends BaseService
{
    public function getCategoryArticles(int $perPage): array
    {
        $result['articles'] = [];

        $id = $this->repository->getIdByCategory($this->request->getCategory());
        if (empty($id)) {
            $_SESSION['message'] = 'This category doesnt exist!' . "\n";
        } else {
            $ids = $id . ',' . \rtrim($this->repository->getCategoriesIds($this->repository->getAllCategories(), $id), ',');
            $totalItems = $this->repository->getCountArticlesByIdCategory($ids);

            $mode = $params['mode'] ?? 'asc';
            $result['pagination'] = $this->getPaginationObject( $this->request->getGET(), $perPage, $totalItems, $mode);
            $result['articles'] = $this->pagination($result['pagination'], 'articles', 'is_active=1', 'getArticles', [$ids]);
            if (empty($result['articles'])) {
                $_SESSION['message'] = 'Articles with this category doesnt exist!' . "\n";
            }
        }

        return $result;
    }

}
