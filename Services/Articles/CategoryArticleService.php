<?php
declare(strict_types=1);

namespace app\Services\Articles;

use app\Services\BaseService;

class CategoryArticleService extends BaseService
{
    public function getCategoryArticles(string $category): array
    {
        $id = $this->repository->getIdByTitle($category);
        if (empty($id)) {
            $_SESSION['warning'] = 'This category doesnt exist!' . "\n";
        }

        $result = $this->repository->getArticlesByCategory($id);
        if (empty($result)) {
            $_SESSION['warning'] = 'Articles with this category doesnt exist!' . "\n";
        }

        return $result;
    }

}
