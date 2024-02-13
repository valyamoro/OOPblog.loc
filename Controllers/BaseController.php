<?php
declare(strict_types=1);

namespace app\Controllers;

use app\core\Controller;
use app\core\Factory\RepositoryFactory;
use app\core\Factory\ServiceFactory;
use app\core\Http\Request;
use app\Database\PDODriver;
use app\Services\BaseController\BaseControllerService;
use app\Services\BaseController\Repositories\BaseControllerRepository;
use app\Services\BaseService;

class BaseController extends Controller
{
    protected const PER_PAGE = 5;
    public function __construct(
        Request $request,
        array $segmentsOfService,
    )
    {
        parent::__construct($request, $segmentsOfService);
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
