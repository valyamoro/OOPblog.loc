<?php
declare(strict_types=1);

namespace app\Controllers;

class HomeController extends BaseController
{
    public function index(string $view): string
    {
        $request = $this->request->getGET();
        $itemsPerPage = 5;

        $result = $this->service->getAll($request, $itemsPerPage);

        return $this->view->render($view, '', $result);
    }

}
