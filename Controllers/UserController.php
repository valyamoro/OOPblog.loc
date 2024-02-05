<?php
declare(strict_types=1);

namespace app\Controllers;

class UserController extends BaseController
{
    public function auth(): string
    {
        $post = $this->request->getPost();

        $params = $this->service->auth($post);

        return $this->view->render('auth', 'user', $params);
    }

    public function add(): string
    {
        $post = $this->request->getPost();

        $params = $this->service->add($post);

        return $this->view->render('add', 'user', $params);
    }

    public function profile(): string
    {
        $get = $this->request->getGET();

        $perPage = 5;
        $params = $this->service->getUserData($get, $perPage);

        return $this->view->render('profile', 'user', $params);
    }

    public function logout(): void
    {
        $this->service->logout();
    }

}
