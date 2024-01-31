<?php
declare(strict_types=1);

namespace app\Controllers;

use app\core\Controller;
use app\Models\UserModel;

class UserController extends BaseController
{
    public function auth(string $view, string $layout = '', array $params = []): string
    {
        $data = $this->request->getPost();

        $params = $this->service->auth($data);

        return $this->view->render($view, $layout, $params);
    }

    public function add(string $view, string $layout = '', array $params = []): string
    {
        $data = $this->request->getPost();

        $params = $this->service->add($data);

        return $this->view->render($view, $layout, $params);
    }

    public function profile(string $view, string $layout = '', array $params = []): string
    {
        $request = $this->request->getGET();

        $params = $this->service->getUserData($request, 5);

        return $this->view->render($view, $layout, $params);
    }

    public function logout(): void
    {
        $this->service->logout();
    }

}
