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

        $ids = $this->repository->getCategoriesIds($this->repository->getAll(), $id);
        $ids = $ids === '' ? (string)$id : \rtrim($ids, ',');

        $result = $this->repository->getArticlesByCategory($id);

        if (empty($result)) {
            $_SESSION['warning'] = 'Articles with this category doesnt exist!' . "\n";
        }

        $articles = $this->repository->getArticles($ids);
        dump($articles);
        if (!array_diff($articles, $result)) {
            $result = [];
        }

        return array_merge($result, $this->repository->getArticles($ids));
    }

}