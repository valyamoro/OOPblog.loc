<?php
declare(strict_types=1);

namespace app\Controllers;

class HomeController extends BaseController
{
    public function index(): string
    {
        $get = $this->request->getGET();

        $result = $this->service->getAll($get, self::PER_PAGE);

        return $this->view->render('index', '', $result);
    }

}
