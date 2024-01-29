<?php

namespace app\Services\Users;

use app\Services\BaseService;

class ProfileUserService extends BaseService
{
    public function getProfileData(array $request): array
    {
        $result['articles'] = [];

        if (empty($request['id']) && empty($_SESSION['user'])) {
            $_SESSION['warning'] = 'You are not authorized!' . "\n";
            \header('Location: /users/auth');
        }

        $id = 0;

        if (empty($request['id']) && !empty($_SESSION['user'])) {
            $id = $_SESSION['user']['id'];
        }

        if (!empty($request['id']) && !empty($_SESSION['user'])) {
            $id = $request['id'];
        }

        if (!empty($request['id']) && empty($_SESSION['user'])) {
            $id = $request['id'];
        }

        $result['user'] = $this->repository->getUserById($id);

        if (empty($result['user']))  {
            $_SESSION['warning'] = 'This user doesnt exist!' . "\n";
        } else {
            $result['articles'] = $this->repository->getArticlesById($result['user']['id']);
        }

        if (empty($result['articles'])) {
            $result['warning'] = 'User doesnt have a articles' . "\n";
        }

        return $result;
    }

}
