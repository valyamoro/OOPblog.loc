<?php
declare(strict_types=1);

namespace app\Controllers;

class HomeController extends BaseController
{
    public function index(): string
    {
        $request = $this->request->getGET();
        $perPage = 5;

        $result = $this->service->getAll($request, $perPage);

        return $this->view->render('index', '', $result);
    }

}
