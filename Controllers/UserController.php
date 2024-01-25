<?php
declare(strict_types=1);

namespace app\Controllers;

use app\core\Controller;
use app\Models\UserModel;

class UserController extends Controller
{
    public function auth(string $view, string $layout = '', array $params = []): string
    {
        $data = $this->request->getPost();

        $params['validate'] = $this->service->auth($data);

        return $this->view->render($view, $layout, $params);
    }

    public function add(string $view, string $layout = '', array $params = []): string
    {
        $data = $this->request->getPost();

        $params['validate'] = $this->service->add($data);

        return $this->view->render($view, $layout, $params);
    }

    public function profile(string $view, string $layout = '', array $params = []): string
    {
        $data = $this->request->getGET();

        $params['user'] = $this->service->getProfileData()['user'];
        $params['articles'] = $this->service->getProfileData()['articles'];

        return $this->view->render($view, $layout, $params);
    }

    public function logout(): void
    {
        unset($_SESSION['user']);
        $_SESSION['message'] = 'You logout!' . "\n";
        \header('Location: /home');
    }

}
