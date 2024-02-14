<?php
declare(strict_types=1);

namespace app\Services\Article;

use app\Services\BaseService;

class ShowArticleService extends BaseService
{
    public function show(int $perPage): array
    {
        $get = $this->request->getGET();
        $id = (int)$get['id'];

        $result['article'] = $this->repository->getById($id);

        if (empty($result['article'])) {
            $_SESSION['message'] = 'This article doesnt exist!' . "\n";
            \header('Location: /');
        }

        $totalItems = $this->repository->getCount('comments', "is_active=1 and is_blocked=0 and id_article={$id}");

        $mode = $get['mode'] ?? 'asc';
        $result['pagination'] = $this->getPaginationObject($get, $perPage, $totalItems, $mode);
        $result['comments_id'] = $this->pagination($result['pagination'], 'comments',
            "is_active=1 and id_article={$id}");

        if (empty($result['comments_id'])) {
            $result['warning'] = 'This article doesnt have a comments!' . "\n";
        } else {
            $result['comments'] = $this->repository->getCommentsByIds($result['comments_id'], $mode);
        }

        return $result;
    }

}
