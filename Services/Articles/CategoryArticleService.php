<?php
declare(strict_types=1);

namespace app\Services\Articles;

use app\Services\BaseService;

class CategoryArticleService extends BaseService
{
    public function getCategoryArticles(array $request, string $category, int $itemsPerPage): array
    {
        $result['articles'] = [];

        $id = $this->repository->getIdByTitle($category);

        if (empty($id)) {
            $_SESSION['message'] = 'This category doesnt exist!' . "\n";
        } else {
            $ids = \rtrim($this->repository->getCategoriesIds($this->repository->getAllCategories(), $id), ',');
            $page = 'articles';
            $totalItems = $this->repository->getCountArticlesByIdCategory($ids);
            $result['pagination'] = $this->getPaginationObject($request, $itemsPerPage, $totalItems);

            $result['articles'] = $this->pagination($result['pagination'], $page, 'is_active=1', 'getArticles', [$ids]);
            if (empty($result['articles'])) {
                $_SESSION['message'] = 'Articles with this category doesnt exist!' . "\n";
            }
        }

        return $result;
    }

}
