<?php
declare(strict_types=1);

namespace app\Controllers;

class ArticleController extends BaseController
{
    public function show(string $view, string $layout): string
    {
        $request = $this->request->getGET();

        $itemsPerPage = 5;
        $data = $this->service->show($request, $itemsPerPage);

        return $this->view->render($view, $layout, $data);
    }

    public function add(string $view, string $layout): string
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

        $params = $this->service->edit($request);

        return $this->view->render($view, $layout, $params);
    }

    public function category(string $view, string $layout, string $category): string
    {
        $request = $this->request->getGET();
        $itemsPerPage = 5;

        $result = $this->service->getCategoryArticles($request, $category, $itemsPerPage);

        return $this->view->render($view, $layout, $result);
    }

    public function delete(): string
    {
        $request = $this->request->getGET();

        $this->service->delete($request);

        return '';
    }

    public function block(): string
    {
        $request = $this->request->getGET();

        $this->service->block($request);

        return '';
    }

    public function unBlock(): string
    {
        $request = $this->request->getGET();

        $this->service->unBlock($request);

        return '';
    }

    public function search(string $view, string $layout): string
    {
        $request = $this->request->getPost();

        $itemsPerPage = 5;
        $params = $this->service->search($request, $itemsPerPage);

        return $this->view->render($view, $layout, $params);
    }

}
