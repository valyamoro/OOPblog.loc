<?php

namespace app\Controllers;

use app\core\Controller;

class ArticleController extends Controller
{
    public function show(string $view, string $layout = '', array $params = []): string
    {
        $request = $this->request->getGET();

        $data['article'] = $this->service->show($request['id']);

        return $this->view->render($view, $layout, $data);
    }

    public function add(string $view, string $layout = '', array $params = []): string
    {
        $request = $this->request->getPost();

        $params['validate'] = $this->service->add($request);

        return $this->view->render($view, $layout, $params);
    }

}
