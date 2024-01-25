<?php

namespace app\Services\Articles;

use app\Services\BaseService;

class ShowArticleService extends BaseService
{
    public function show(int $id)
    {
        $result = $this->repository->getById($id);

        if (empty($result)) {
            $_SESSION['warning'] = 'Такого продукта не существует!' . "\n";
        }

        return $result;
    }
}