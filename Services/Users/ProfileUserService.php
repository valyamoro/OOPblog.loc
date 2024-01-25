<?php

namespace app\Services\Users;

use app\Services\BaseService;

class ProfileUserService extends BaseService
{
    public function getProfileData(): array
    {
        $result['user'] = [];
        $result['articles'] = [];

        if (empty($_GET['id']) && empty($_SESSION['user'])) {
            $_SESSION['warning'] = 'You not authorized!' . "\n";
            \header('Location: /users/add');
        }

        if (empty($_GET['id']) && !empty($_SESSION['user'])) {
            $result['user'] = $this->repository->getUserById($_SESSION['user']['id']);
        }

        if (!empty($_GET['id']) && !empty($_SESSION['user'])) {
            $result['user'] = $this->repository->getUserById($_GET['id']);
        }

        if (!empty($_GET['id']) && empty($_SESSION['user'])) {
            $result['user'] = $this->repository->getUserById($_GET['id']);
        }

        if (empty($result['user']))  {
            $_SESSION['warning'] = 'Такого пользователя не существует!' . "\n";
        } else {
            $result['articles'] = $this->repository->getArticlesById($result['user']['id']);
        }

        return $result;
    }

}
