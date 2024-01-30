<?php
declare(strict_types=1);

namespace app\Services\Articles;

use app\Services\BaseService;

class ShowArticleService extends BaseService
{
    public function show(array $request): array
    {
        $id = $request['id'];

        $result['article'] = $this->repository->getById($id);
        $result['comments'] = $this->repository->getCommentsById($id);

        if (empty($result['article'])) {
            $_SESSION['message'] = 'This article doesnt exist!' . "\n";
            \header('Location: /articles');
        }

        if (empty($result['comments'])) {
            $result['warning'] = 'This article doesnt have a comments!' . "\n";
        }

        return $result;
    }

}
