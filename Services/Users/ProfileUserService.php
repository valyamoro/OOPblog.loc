<?php

namespace app\Services\Users;

use app\Services\BaseService;

class ProfileUserService extends BaseService
{
    public function getUserData(array $request): array
    {
        $result['articles'] = [];

        if (empty($request['id']) && empty($_SESSION['user'])) {
            $_SESSION['warning'] = 'You are not authorized!' . "\n";
            \header('Location: /users/auth');
        }

        $id = $this->getUserId($request);

        $result['user'] = $this->repository->getUserById($id);

        if (empty($result['user'])) {
            $_SESSION['warning'] = 'This user doesnt exist!' . "\n";
        } else {
            $result['articles'] = $this->repository->getArticlesById($result['user']['id']);
        }

        if (empty($result['articles'])) {
            $result['warning'] = 'There are no articles here' . "\n";
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
