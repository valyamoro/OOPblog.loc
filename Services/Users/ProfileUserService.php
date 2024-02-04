<?php

namespace app\Services\Users;

use app\Services\BaseService;

class ProfileUserService extends BaseService
{
    public function getUserData(array $request, int $itemsPerPage): array
    {
        $result['articles'] = [];

        if (empty($request['id']) && empty($_SESSION['user'])) {
            $_SESSION['warning'] = 'You are not authorized!' . "\n";
            \header('Location: /users/auth');
        }

        $id = $this->getUserId($request);
        $result['user'] = $this->repository->getUserById($id);

        if (empty($result['user'])) {
            $_SESSION['message'] = 'This user doesnt exist!' . "\n";
            \header('Location: /');
        } else {
            $totalItems = $this->repository->getCountUserArticles($id);

            $mode = $request['mode'] ?? 'asc';
            $result['pagination'] = $this->getPaginationObject($request, $itemsPerPage, $totalItems, $mode);
            $result['articles_id'] = $this->pagination($result['pagination'], 'articles', 'is_blocked=0 and is_active=1', 'getUserArticlesIds', [$id]);

            if (empty($result['articles_id'])) {
                $result['warning'] = 'There are no articles on the site' . "\n";
            } else {
                $result['articles'] = $this->repository->getArticlesByIds($result['articles_id'], $mode);
            }
        }

        return $result;
    }

    private function getUserId(array $request): int
    {
        $id = 0;

        if (empty($request['id']) && !empty($_SESSION['user'])) {
            $id = $_SESSION['user']['id'];
        }

        if ((!empty($request['id']) && !empty($_SESSION['user'])) || (!empty($request['id']) && empty($_SESSION['user']))) {
            $id = $request['id'];
        }

        return (int)$id;
    }

}
