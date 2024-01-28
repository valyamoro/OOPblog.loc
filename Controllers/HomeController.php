<?php
declare(strict_types=1);

namespace app\Controllers;

use app\core\Controller;

class HomeController extends BaseController
{
    public function index(string $view, string $layout = '', array $params = []): string
    {
        $result = $this->service->getAll();

        return $this->view->render($view, $layout, $result);
    }

    public function categoriesToString(array $data): string
    {
        foreach ($data as $item) {
            $string .= categoriesToTemplate($item);
        }

        return $string;
    }

    public function categoriesToTemplate(array $data): string
    {
        \ob_start();

    }
}
