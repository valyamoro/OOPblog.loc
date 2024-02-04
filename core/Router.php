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

    public function dispatch(Request $request): ?string
    {
        $parts = $request->parseUrl();
        $segments = $parts['path'] === '/'
            ? ['Home']
            : \explode('/', \trim($parts['path'], '/'));

        $namespaceController = 'app\Controllers\\';

        $class = $namespaceController . \rtrim($segments[0], 's');

        $namespaceService = "app\Services\\{$segments[0]}";
        $nameRepository = $segments[0];
        $nameService = $segments[0];
        $method = 'index';

        $segments[0] = \rtrim($segments[0], 's');
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

        $connectionDB = $this->connectionDB();
        $repository = new ("{$namespaceService}\\Repositories\\{$nameRepository}Repository")($connectionDB);
        $service = new ("{$namespaceService}\\{$nameService}Service")($repository);

        $class = (new ($class . 'Controller')($connectionDB, $request, $service));

        return $class->{$method}();
    }

    private function connectionDB(): PDODriver
    {
        $configuration = require __DIR__ . '/../config/db.php';

        $dataBaseConfiguration = new DatabaseConfiguration(...$configuration);
        $dataBasePDOConnection = new DatabasePDOConnection($dataBaseConfiguration);

        return new PDODriver($dataBasePDOConnection->connection());
    }

}
