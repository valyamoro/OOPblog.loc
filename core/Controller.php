<?php
declare(strict_types=1);

namespace app\core;

use app\core\Factory\RepositoryFactory;
use app\core\Factory\ServiceFactory;
use app\core\Http\Request;
use app\Database\PDODriver;
use app\Services\BaseService;

abstract class Controller
{
    protected BaseService $service;
    protected View $view;

    public function __construct(
        protected Request $request,
        array $segmentsOfService,
    ) {
        $this->view = new View();
        $this->service = ($this->getServiceObject($segmentsOfService[0], $segmentsOfService[1]));
    }

    protected function getServiceObject(string $repositoryServiceName, string $action = ''): BaseService
    {
        $repository = RepositoryFactory::createRepository($repositoryServiceName, $action);
        return ServiceFactory::createService($repository, $this->request, $repositoryServiceName, $action);
    }

}
