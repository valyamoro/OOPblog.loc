<?php
declare(strict_types=1);

namespace app\Controllers;

class AdminController extends BaseController
{
    public function moderate(): string
    {
        $get = $this->request->getGET();

        $perPage = 5;
        $params = $this->service->getAll($get, $perPage);

        return $this->view->render('moderate', 'admin', $params);
    }

    public function delete(): string
    {
        $get = $this->request->getGET();

        $this->service->delete($get);

        return '';
    }

    public function approve(): string
    {
        $get = $this->request->getGET();

        $this->service->approve($get);

        return '';
    }

    public function unBlock(): string
    {
        $get = $this->request->getGET();

        $this->service->unBlock($get);

        return '';
    }

    public function add(): string
    {
        $post = $this->request->getPost();

        $params = $this->service->add($post);

        return $this->view->render('add', 'admin', $params);
    }

    public function category(): string
    {
        $post = $this->request->getPost();

        $params = $this->service->add($post);
        $params['categories'] = $this->service->getCategories();

        return $this->view->render('category', 'admin', $params);
    }

    public function panel(): string
    {
        $this->service->panel();

        return $this->view->render('panel', 'admin', []);
    }

}
