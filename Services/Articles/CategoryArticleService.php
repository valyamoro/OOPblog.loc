<?php
declare(strict_types=1);

namespace app\Services\Articles;

use app\Services\BaseService;

class CategoryArticleService extends BaseService
{
    public function getCategoryArticles(string $category): array
    {
        $id = (int)$this->repository->getIdByTitle($category);
        if (empty($id)) {
            $_SESSION['warning'] = 'This category doesnt exist!' . "\n";
        }

        $ids = \rtrim($this->repository->getCategoriesIds($this->repository->getAllCategories(), $id), ',');

        $result['articles'] = $this->repository->getArticles($ids);
        if (empty($result['articles'])) {
            $_SESSION['warning'] = 'Articles with this category doesnt exist!' . "\n";
        }

        return $result;
    }

}
