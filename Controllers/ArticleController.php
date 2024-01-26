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
        $params['validate'] = $this->service->add($this->request->getPost());

        return $this->view->render($view, $layout, $params);
    }

    public function edit(string $view, string $layout = '', array $params = []): string
    {
        $request['get'] = $this->request->getGET();
        $request['post'] = $this->request->getPost();

        $this->service->edit($request);

        return $this->view->render($view, $layout, $params);
    }

}
