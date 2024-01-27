<?php

namespace app\Services\Articles;

use app\Services\BaseService;

class ShowArticleService extends BaseService
{
    public function show(int $id)
    {
        $result['article'] = $this->repository->getById($id);
        $result['comments'] = $this->repository->getCommentsById($id);

        if (empty($result['article'])) {
            $_SESSION['warning'] = 'Такого продукта не существует!' . "\n";
        }

        if (empty($result['comments'])) {
            $result['warning'] = 'В этой статье нет комментариев!' . "\n";
        }

        return $result;
    }

}
