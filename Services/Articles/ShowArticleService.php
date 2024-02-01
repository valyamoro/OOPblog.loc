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

        if (empty($result['article'])) {
            $_SESSION['message'] = 'This article doesnt exist!' . "\n";
            \header('Location: /articles');
        }

        $totalItems = $this->repository->getCount('comments', "is_active=1 and is_blocked=0 and id_article={$id}");
        $result['pagination'] = $this->getPaginationObject($request, $itemsPerPage, $totalItems);
        $result['comments_id'] = $this->pagination($result['pagination'], 'comments',
            "is_active=1 and id_article={$id}");

        if (empty($result['comments_id'])) {
            $result['warning'] = 'This article doesnt have a comments!' . "\n";
        } else {
            $result['comments'] = $this->repository->getCommentsByIds($result['comments_id']);
        }

        return $result;
    }

}
