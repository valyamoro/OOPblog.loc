<?php
declare(strict_types=1);

namespace app\Services\Articles;

use app\Services\BaseService;

class ShowArticleService extends BaseService
{
    public function show(array $request, int $itemsPerPage): array
    {
        $id = (int)$request['id'];

        $result['article'] = $this->repository->getById($id);

        $totalItems = $this->repository->getCount('comments');
        $result['pagination'] = $this->getPaginationObject($request, $itemsPerPage, $totalItems);
        $result['comments'] = $this->pagination($result['pagination'], 'comments', 'is_active=1');

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
