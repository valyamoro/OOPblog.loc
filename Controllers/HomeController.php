<?php
declare(strict_types=1);

namespace app\Controllers;

use app\core\Controller;

class HomeController extends Controller
{
    public function index(string $view, array $params = []): string
    {
        $result = $this->service->getAll();

        return $this->view->render($view, $result);
    }

}
