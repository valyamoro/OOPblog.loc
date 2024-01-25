<?php

namespace app\Controllers;

use app\core\Controller;

class ArticleController extends Controller
{
    public function index(string $view, string $layout = '', array $params = []): string
    {
        $request = $this->request->getGET();

        $data['article'] = $this->service->show($request['id']);

        return $this->view->render($view, $layout, $data);
    }

    public function add(string $view, string $layout = '', array $params = []): string
    {
        $request = $this->request->getPost();

        $this->service->add($request);

        return $this->view->render($view, $layout, $params);
    }

}