<?php
declare(strict_types=1);

namespace app\core;

use app\core\Http\Request;

class Router
{
    public function dispatch(Request $request): ?string
    {
        $segments = $request->createSegmentsOfUri($request);
        $method = \count($segments) === 1 ? 'index' : $segments[1];

        $segments[0] = \rtrim($segments[0], 's');

        $segments[1] ??= '';

        $controllerName = "app\\Controllers\\{$segments[0]}Controller";
        $controller = new $controllerName($request, $segments);

        return $controller->{$method}();
    }

}
