<?php
declare(strict_types=1);

namespace app\Controllers;

class ArticleController extends BaseController
{
    public function show(): string
    {
        $request = $this->request->getGET();

        $perPage = 5;
        $data = $this->service->show($request, $perPage);

        return $this->view->render('show', 'article', $data);
    }

    public function add(): string
    {
        $request['post'] = $this->request->getPost();
        $request['files'] = $this->request->getFiles();

        $params = $this->service->add($request);

        return $this->view->render('add', 'article', $params);
    }

    public function edit(): string
    {
        $request['get'] = $this->request->getGET();
        $request['post'] = $this->request->getPost();
        $request['files'] = $this->request->getFiles();

        $params = $this->service->edit($request);

        return $this->view->render('edit', 'article', $params);
    }

    public function category(): string
    {
        $perPage = 5;

        $result = $this->service->getCategoryArticles($this->request, $perPage);

        return $this->view->render('category', 'article', $result);
    }

    public function delete(): void
    {
        $request = $this->request->getGET();

        $this->service->delete($request);
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

    public function search(): string
    {
        $request = $this->request->getPost();

        $params = $this->service->search($request);

        return $this->view->render('search', 'article', $params);
    }

}
