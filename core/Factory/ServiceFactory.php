<?php
declare(strict_types=1);

namespace app\core\Factory;

use app\core\Http\Request;
use app\Services\BaseRepository;
use app\Services\BaseService;

class ServiceFactory
{
    public static function createService(BaseRepository $repository, Request $request, string $serviceName, string $action = ''): BaseService
    {
        return new ("app\Services\\{$serviceName}\\{$action}{$serviceName}Service")($repository, $request);
    }

}
