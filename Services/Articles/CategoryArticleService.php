<?php
declare(strict_types=1);

namespace app\Services\Articles;

use app\Services\BaseService;

class CategoryArticleService extends BaseService
{
    public function getCategoryArticles(string $category)
    {
        $id = $this->repository->getIdByTitle($category);

        return $this->repository->getArticlesByCategory($id);
    }

}
