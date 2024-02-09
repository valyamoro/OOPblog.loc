<?php
declare(strict_types=1);

namespace app\core;

use app\core\Http\Request;

class Router
{
    public function dispatch(Request $request): string
    {
        $segments = $request->createSegmentsOfUri($request);
        $method = \count($segments) === 1 ? 'index' : $segments[1];

        $segments[0] = \rtrim($segments[0], 's');
        $class = "app\\Controllers\\{$segments[0]}";

        $segments[1] ??= '';
        $class = new ($class . 'Controller')($request, $segments);

        return $class->{$method}();
    }

}
