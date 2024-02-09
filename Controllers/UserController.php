<?php
declare(strict_types=1);

namespace app\Controllers;

class UserController extends BaseController
{
    public function auth(): string
    {
        $post = $this->request->getPost();

        $result = $this->service->auth($post);

        return $this->view->render('auth', 'user', $result);
    }

    public function add(): string
    {
        $post = $this->request->getPost();

        $result = $this->service->add($post);

        return $this->view->render('add', 'user', $result);
    }

    public function profile(): string
    {
        $get = $this->request->getGET();

        $result = $this->service->getUserData($get, self::PER_PAGE);

        return $this->view->render('profile', 'user', $result);
    }

    public function logout(): void
    {
        $this->service->logout();
    }

}
