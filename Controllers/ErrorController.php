<?php

namespace app\Controllers;

class ErrorController extends BaseController
{
    public function _404(string $view, string $layout): string
    {
        return $this->view->render($view, $layout, []);
    }
}