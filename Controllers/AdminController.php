<?php
declare(strict_types=1);

namespace app\Controllers;

use app\core\Controller;

class AdminController extends BaseController
{
    public function moderate(string $view, string $layout, array $params = []): string
    {
        $request = $this->request->getGET();

        $data = $this->service->getAll($request['page']);

        return $this->view->render($view, $layout, $data);
    }

    public function delete(): void
    {
        $request = $this->request->getGET();
        $this->service->delete($request['id']);
    }

    public function approve(): void
    {
        $request = $this->request->getGET();
        $this->service->approve($request['id']);
    }

    public function add(string $view, string $layout): string
    {
        $request = $this->request->getPost();

        $data = $this->service->add($request);

        return $this->view->render($view, $layout, $data);
    }

    public function category(string $view, string $layout, array $params = []): string
    {
        $request = $this->request->getPost();

        $this->service->add($request);
        $result['categories'] = $this->service->getCategories();

        return $this->view->render($view, $layout, $result);
    }
}
