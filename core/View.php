<?php
declare(strict_types=1);

namespace app\core;

class View
{
    public function render(string $view, string $layout, $params = []): string
    {
        $layoutContent = $this->layoutContent($params);
        $viewContent = $this->renderOnlyView($view, $layout, $params);
        return \str_replace('{{content}}', $viewContent, $layoutContent);
    }

    protected function renderOnlyView(string $view, string $layout, $params): string
    {
        \extract($params);
        \ob_start();
        require_once __DIR__ . "/../Views/{$layout}/{$view}.php";
        return \ob_get_clean();
    }

    protected function layoutContent($params = []): string
    {
        \extract($params);
        \ob_start();
        require_once __DIR__ . '/../Views/layouts/main.php';
        return \ob_get_clean();
    }

}
