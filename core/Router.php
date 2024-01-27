<?php
declare(strict_types=1);

namespace app\core;

use app\core\Http\Request;
use app\Database\DatabaseConfiguration;
use app\Database\DatabasePDOConnection;
use app\Database\PDODriver;

class Router
{
    private function getUri(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    private function dispatch(): string
    {
        $parts = \parse_url($this->getUri());
        $segments = $parts['path'] === '/'
            ? 'Home'
            : \explode('/', \trim($parts['path'], '/'));

        $namespace = 'app\Controllers\\';
        $method = 'index';
        $params = 'index';

        if ($segments === 'Home') {
            $class = $namespace . $segments;
        } else {
            $params = [$segments[0], $segments[0]];
            $class = $namespace . \rtrim($segments[0], 's');
        }

        $connectionDB = $this->connectionDB();

        $namespace = "app\Services\\{$segments[0]}";
        $segments[0] = \rtrim($segments[0], 's');

        if (\is_array($segments)) {
            if (\count($segments) === 1) {
                $repository = new ("{$namespace}\Repositories\\" . $segments[0] . 'Repository')($connectionDB);
                $service = new ("{$namespace}\\" . $segments[0] . 'Service')($repository);
            } elseif (\count($segments) === 2) {
                $method = $segments[1];
                $repository = new ("{$namespace}\Repositories\\" . $segments[1] . $segments[0] . 'Repository')($connectionDB);
                $service = new ("{$namespace}\\{$segments[1]}" . $segments[0] . 'Service')($repository);
                $params = [$segments[1], $segments[0]];
            } elseif (\count($segments) === 3) {
                $repository = new ("{$namespace}\Repositories\\" . $segments[1] . $segments[0] . 'Repository')($connectionDB);
                $service = new ("{$namespace}\\{$segments[1]}" . $segments[0] . 'Service')($repository);
                $method = $segments[1];
                $params = [$segments[1], $segments[0], $segments[2]];
            } elseif (\count($segments) === 5) {
                $repository = new ("{$namespace}\Repositories\\" . $segments[3] . \rtrim($segments[0],
                        's') . 'Repository')($connectionDB);
                $service = new ("{$namespace}\\" . $segments[3] . $segments[0] . 'Service')($repository);
                $method = $segments[3];
                $params = [$segments[3], $segments[2], $segments[4]];
            }
        } else {
            $repository = new ("app\Services\\{$segments}\\Repositories\\" . $segments . 'Repository')($connectionDB);
            $service = new ("app\Services\\{$segments}\\{$segments}" . 'Service')($repository);
        }

        $request = new Request();
        $class = (new ($class . 'Controller')($connectionDB, $request, $service));

        if (\is_array($params)) {
            return $class->{$method}(...$params);
        } else {
            return $class->{$method}($params);
        }

    }

    private function connectionDB(): PDODriver
    {
        $configuration = require __DIR__ . '/../config/db.php';

        $dataBaseConfiguration = new DatabaseConfiguration(...$configuration);
        $dataBasePDOConnection = new DatabasePDOConnection($dataBaseConfiguration);

        return new PDODriver($dataBasePDOConnection->connection());
    }

    public function resolve(): void
    {
        echo $this->dispatch();
    }

}
