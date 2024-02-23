<?php
declare(strict_types=1);

namespace app\Controllers;

class UserController extends BaseController
{
    public function auth(): string
    {
        $result = $this->service->auth();

        return $this->view->render('auth', 'user', $result);
    }

    public function add(): string
    {
        $result = $this->service->add();

        return $this->view->render('add', 'user', $result);
    }

    public function profile(): string
    {
        $result = $this->service->getUserData(self::PER_PAGE);

        return $this->view->render('profile', 'user', $result);
    }

    public function logout(): void
    {
        $this->service->logout();
    }

}
