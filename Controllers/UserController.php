<?php
declare(strict_types=1);

namespace app\Controllers;

class UserController extends BaseController
{
    public function auth(): string
    {
        $data = $this->request->getPost();

        $params = $this->service->auth($data);

        return $this->view->render('auth', 'user', $params);
    }

    public function add(): string
    {
        $data = $this->request->getPost();

        $params = $this->service->add($data);

        return $this->view->render('add', 'user', $params);
    }

    public function profile(): string
    {
        $request = $this->request->getGET();

        $params = $this->service->getUserData($request, 5);

        return $this->view->render('profile', 'user', $params);
    }

    public function logout(): void
    {
        $this->service->logout();
    }

}
