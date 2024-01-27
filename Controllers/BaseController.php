<?php

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

        return $service->getAllCategories();
    }

}
