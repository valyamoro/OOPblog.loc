<?php

namespace app\Services\User;

use app\Services\BaseService;

class ProfileUserService extends BaseService
{
    public function getUserData(array $get, int $perPage): array
    {
        $result['articles'] = [];

        if (empty($get['id']) && empty($_SESSION['user'])) {
            $_SESSION['warning'] = 'You are not authorized!' . "\n";
            \header('Location: /users/auth');
        }

        $id = $this->getUserId($get);
        $result['user'] = $this->repository->getUserById($id);

        if (empty($result['user'])) {
            $_SESSION['message'] = 'This user doesnt exist!' . "\n";
            \header('Location: /');
        } else {
            $totalItems = $this->repository->getCountUserArticles($id);

            $mode = $get['mode'] ?? 'asc';
            $result['pagination'] = $this->getPaginationObject($get, $perPage, $totalItems, $mode);
            $condition = 'users_articles.id_user=? and is_active=1 and is_blocked=0';
            $result['articles'] = $this->pagination($result['pagination'], 'articles', $condition, 'getUserArticlesIds', [$id]);

            if (empty($result['articles'])) {
                $result['warning'] = 'There are no articles on the site' . "\n";
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
