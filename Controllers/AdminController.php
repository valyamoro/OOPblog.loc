<?php
declare(strict_types=1);

namespace app\Controllers;

class AdminController extends BaseController
{
    public function moderate(): string
    {
        $request = $this->request->getGET();

        $perPage = 5;
        $params = $this->service->getAll($request, $perPage);

        return $this->view->render('moderate', 'admin', $params);
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

    public function add(): string
    {
        $request = $this->request->getPost();

        $params = $this->service->add($request);

        return $this->view->render('add', 'admin', $params);
    }

    public function category(): string
    {
        $request = $this->request->getPost();

        $params = $this->service->add($request);
        $params['categories'] = $this->service->getCategories();

        return $this->view->render('category', 'admin', $params);
    }

    public function panel(): string
    {
        $this->service->panel();

        return $this->view->render('panel', 'admin', []);
    }

}
