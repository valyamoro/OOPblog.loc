<?php
declare(strict_types=1);

namespace app\Controllers;

use app\core\Controller;
use app\core\Http\Request;
use app\Database\PDODriver;
use app\Services\Base\BaseControllerService;
use app\Services\Base\Repositories\BaseControllerRepository;
use app\Services\BaseService;

class BaseController extends Controller
{
    public function __construct(Request $request, BaseService $service)
    {
        parent::__construct($request, $service);
        $this->view->setData($this->getMenuCategories());
    }

    private function getMenuCategories(): array
    {
        $repository = new BaseControllerRepository();
        $service = new BaseControllerService($repository);

        $menu = '<ul class="menu"><li><a href="/">All categories</a><ul class="sub-menu">';
        $menu .= $this->createMenu($service->getAllCategories());
        $menu .= '</ul></ul></ul>';

        $result['menu'] = $menu;
        return $result;
    }

    private function createMenu(array $data): string
    {
        $string = '';

        foreach ($data as $value) {
            $string .= "<li><a href='/articles/category/{$value['title']}'> {$value['title']}</a>";
            if (!empty($value['child'])) {
                $string .= "<ul class='menu'>";
                $string .= $this->createMenu($value['child']);
            }
        }

        return ($string . '</ul>');
    }

}
