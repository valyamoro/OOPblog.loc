<?php
declare(strict_types=1);

namespace app\core;

use app\core\Http\Request;
use app\Database\PDODriver;
use app\Services\BaseService;

abstract class Controller
{
    protected View $view;

    public function __construct(
        protected Request $request,
        protected BaseService $service,
    ) {
        $this->view = new View();
    }

}
