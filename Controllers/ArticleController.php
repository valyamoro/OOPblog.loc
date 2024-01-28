<?php
declare(strict_types=1);

namespace app\Controllers;

use app\core\Controller;

class ArticleController extends BaseController
{
    public function show(string $view, string $layout): string
    {
        $request = $this->request->getGET();

        $data = $this->service->show($request['id']);

        return $this->view->render($view, $layout, $data);
    }

    public function add(string $view, string $layout, array $params = []): string
    {
        $request['post'] = $this->request->getPost();
        $request['files'] = $this->request->getFiles();

        $params['validate'] = $this->service->add($request);

        return $this->view->render($view, $layout, $params);
    }

    public function edit(string $view, string $layout, array $params = []): string
    {
        $request['get'] = $this->request->getGET();
        $request['post'] = $this->request->getPost();
        $request['files'] = $this->request->getFiles();

        $this->service->edit($request);

        return $this->view->render($view, $layout, $params);
    }

    public function category(string $view, string $layout, string $params): string
    {
        $result['articles'] = $this->service->getCategoryArticles($params);

        return $this->view->render($view, $layout, $result);
    }

    public function delete(): void
    {
        $request = $this->request->getGET();

        $this->service->delete((int)$request['id']);
    }

}
