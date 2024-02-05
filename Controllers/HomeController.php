<?php
declare(strict_types=1);

namespace app\Controllers;

class HomeController extends BaseController
{
    public function index(): string
    {
        $get = $this->request->getGET();
        $perPage = 5;

        $result = $this->service->getAll($get, $perPage);

        return $this->view->render('index', '', $result);
    }

}
