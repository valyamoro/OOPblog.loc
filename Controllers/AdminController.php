<?php
declare(strict_types=1);

namespace app\Controllers;

class AdminController extends BaseController
{
    public function moderate(): string
    {
        $result = $this->service->getAll(self::PER_PAGE);

        return $this->view->render('moderate', 'admin', $result);
    }

    public function delete(): void
    {
        $this->service->delete();
    }

    public function approve(): void
    {
        $this->service->approve();
    }

    public function unBlock(): void
    {
        $this->service->unBlock();
    }

    public function add(): string
    {
        $result = $this->service->add();

        return $this->view->render('add', 'admin', $result);
    }

    public function category(): string
    {
        $result = $this->service->add();
        $result['categories'] = $this->service->getCategories();

        return $this->view->render('category', 'admin', $result);
    }

    public function panel(): string
    {
        $this->service->panel();

        return $this->view->render('panel', 'admin', []);
    }

}
