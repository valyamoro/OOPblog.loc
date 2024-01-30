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
    public function __construct(PDODriver $PDODriver, Request $request, BaseService $service)
    {
        parent::__construct($PDODriver, $request, $service);
        $this->view->setData($this->getAllCategories());
    }

    public function getAllCategories(): array
    {
        $repository = new BaseControllerRepository($this->PDODriver);
        $service = new BaseControllerService($repository);

        $result['menu'] = $this->createMenu($service->getAllCategories());

        return $result;
    }

    public function createMenu(array $data): string
    {
        $string = '<ul class="menu"><li><a href="#">Categories</a><ul class="sub-menu">';

        foreach ($data as $value) {
            $string .= "<li><a href='/articles/category/{$value['title']}'> {$value['title']}</a>";
            if (!empty($value['childs'])) {
                $string .= "<ul class='menu'>";
                foreach ($value['childs'] as $child) {
                    $string .= "<li><a href='/articles/category/{$child['title']}'> {$child['title']}</a></li>";
                }

                $string .= '</ul>';
            }

            $string .='</li>';
        }

        $string .= '</ul></li></ul></ul>';
        return $string;
    }

}
