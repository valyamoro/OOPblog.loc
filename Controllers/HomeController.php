<?php
declare(strict_types=1);

namespace app\Controllers;

use app\core\Controller;

class HomeController extends BaseController
{
    public function index(string $view, string $layout = '', array $params = []): string
    {
        $request = $this->request->getGET();

        $itemsPerPage = 5;
        $result = $this->service->getAll($request, $itemsPerPage);

        return $this->view->render($view, $layout, $result);
    }

}
