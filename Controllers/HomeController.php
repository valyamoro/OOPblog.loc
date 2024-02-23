<?php
declare(strict_types=1);

namespace app\Controllers;

class HomeController extends BaseController
{
    public function index(): string
    {
        $result = $this->service->getAll(self::PER_PAGE);

        return $this->view->render('index', '', $result);
    }

}
