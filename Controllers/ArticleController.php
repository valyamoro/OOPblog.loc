<?php
declare(strict_types=1);

namespace app\Controllers;

use app\core\Controller;

class ArticleController extends BaseController
{
    public function show(string $view, string $layout): string
    {
        $request = $this->request->getGET();

        $data = $this->service->show($request, 5);

        return $this->view->render($view, $layout, $data);
    }

    public function add(string $view, string $layout, array $params = []): string
    {
        $request['post'] = $this->request->getPost();
        $request['files'] = $this->request->getFiles();

        $params = $this->service->add($request);

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

    public function category(string $view, string $layout, string $category): string
    {
        $request = $this->request->getGET();
        $result = $this->service->getCategoryArticles($request, $category, 5);

        return $this->view->render($view, $layout, $result);
    }

    public function delete(): void
    {
        $request = $this->request->getGET();

        $this->service->delete($request);
    }

    public function block(): void
    {
        $request = $this->request->getGET();

        $this->service->block($request);
    }

    public function unBlock(): void
    {
        $request = $this->request->getGET();

        $this->service->unBlock($request);
    }

    public function search(string $view, string $layout): string
    {
        $request = $this->request->getPost();

        $params = $this->service->search($request);

        return $this->view->render($view, $layout, $params);
    }

}
