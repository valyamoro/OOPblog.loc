<?php
declare(strict_types=1);

namespace app\Controllers;

use app\core\Controller;

class AdminController extends BaseController
{
    public function moderate(string $view, string $layout, array $params = []): string
    {
        $request = $this->request->getGET();

        $data = $this->service->getAll($request, 5);

        return $this->view->render($view, $layout, $data);
    }

    public function delete(): void
    {
        $request = $this->request->getGET();

        $this->service->delete($request);
    }

    public function approve(): void
    {
        $request = $this->request->getGET();

        $this->service->approve($request);
    }

    public function unBlock(): void
    {
        $request = $this->request->getGET();

        $this->service->unBlock($request);
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

        $params = $this->service->add($request);
        $params['categories'] = $this->service->getCategories();

        return $this->view->render($view, $layout, $params);
    }

    public function panel(string $view, string $layout): string
    {
        $this->service->panel();

        return $this->view->render($view, $layout, []);
    }

}
