<?php
declare(strict_types=1);

namespace app\core;

use app\core\Http\Request;
use app\Database\DatabaseConfiguration;
use app\Database\DatabasePDOConnection;
use app\Database\PDODriver;
use Error;
use Exception;

class Router
{
    private function getNames(array $segments): array
    {
        $nameRepository = $segments[0];
        $nameService = $segments[0];
        $segments[0] = \rtrim($segments[0], 's');
        $method = 'index';
        if (\count($segments) === 1) {
            $nameRepository = $segments[0];
            $nameService = $segments[0];
        } elseif (\count($segments) === 2) {
            $method = $segments[1];
            $nameRepository = $segments[1] . $segments[0];
            $nameService = $segments[1] . $segments[0];
        } elseif (\count($segments) === 3) {
            $method = $segments[1];
            $nameRepository = $segments[1] . $segments[0];
            $nameService = $segments[1] . $segments[0];
        }

        return [
            'repository' => $nameRepository,
            'service' => $nameService,
            'method' => $method
        ];
    }

    private function createSegmentsOfUri(Request $request): array
    {
        $parts = $request->parseUri();
        return $parts['path'] === '/'
            ? ['Home']
            : \explode('/', \trim($parts['path'], '/'));
    }

    public function dispatch(Request $request): ?string
    {
        $segments = $this->createSegmentsOfUri($request);
        $names = $this->getNames($segments);

        $connectionDB = $this->connectionDB();
        $namespaceService = "app\Services\\{$segments[0]}";
        $repository = new ("{$namespaceService}\\Repositories\\{$names['repository']}Repository")($connectionDB);
        $service = new ("{$namespaceService}\\{$names['service']}Service")($repository);

        $class = 'app\\Controllers\\' . \rtrim($segments[0], 's');
        $class = new ($class . 'Controller')($connectionDB, $request, $service);

        return $class->{$names['method']}();
    }

    private function connectionDB(): PDODriver
    {
        $configuration = require __DIR__ . '/../config/db.php';

        $dataBaseConfiguration = new DatabaseConfiguration(...$configuration);
        $dataBasePDOConnection = new DatabasePDOConnection($dataBaseConfiguration);

        return new PDODriver($dataBasePDOConnection->connection());
    }

}
