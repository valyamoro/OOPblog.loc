<?php
declare(strict_types=1);

namespace app\Controllers;

class AdminController extends BaseController
{
    public function moderate(string $view, string $layout): string
    {
        $request = $this->request->getGET();

        $itemsPerPage = 5;
        $params = $this->service->getAll($request, $itemsPerPage);

        return $this->view->render($view, $layout, $params);
    }

    public function delete(): string
    {
        $request = $this->request->getGET();

        $this->service->delete($request);

        return '';
    }

    public function approve(): string
    {
        $request = $this->request->getGET();

        $this->service->approve($request);

        return '';
    }

    public function unBlock(): string
    {
        $request = $this->request->getGET();

        $this->service->unBlock($request);

        return '';
    }

    public function add(string $view, string $layout): string
    {
        $request = $this->request->getPost();

        $params = $this->service->add($request);

        return $this->view->render($view, $layout, $params);
    }

    public function category(string $view, string $layout): string
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
