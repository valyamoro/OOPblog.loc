<?php
declare(strict_types=1);

namespace app\Controllers;

class AdminController extends BaseController
{
    public function moderate(): string
    {
        $get = $this->request->getGET();

        $result = $this->service->getAll($get, self::PER_PAGE);

        return $this->view->render('moderate', 'admin', $result);
    }

    public function delete(): void
    {
        $get = $this->request->getGET();

        $this->service->delete($get);
    }

    public function approve(): void
    {
        $get = $this->request->getGET();

        $this->service->approve($get);
    }

    public function unBlock(): void
    {
        $get = $this->request->getGET();

        $this->service->unBlock($get);
    }

    public function add(): string
    {
        $post = $this->request->getPost();

        $result = $this->service->add($post);

        return $this->view->render('add', 'admin', $result);
    }

    public function category(): string
    {
        $post = $this->request->getPost();

        $result = $this->service->add($post);
        $result['categories'] = $this->service->getCategories();

        return $this->view->render('category', 'admin', $result);
    }

    public function panel(): string
    {
        $this->service->panel();

        return $this->view->render('panel', 'admin', []);
    }

}
