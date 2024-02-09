<?php
declare(strict_types=1);

namespace app\Controllers;

use app\Services\BaseController\BaseControllerService;
use app\Services\BaseController\Repositories\BaseControllerRepository;

class ArticleController extends BaseController
{
    public function show(): string
    {
        $get = $this->request->getGET();

        $perPage = 5;
        $data = $this->service->show($get, $perPage);

        return $this->view->render('show', 'article', $data);
    }

    public function add(): string
    {
        $post = $this->request->getPost();
        $files = $this->request->getFiles();

        $params = $this->service->add($post, $files);

        return $this->view->render('add', 'article', $params);
    }

    public function edit(): string
    {
        $get = $this->request->getGET();
        $post = $this->request->getPost();
        $files = $this->request->getFiles();

        $params = $this->service->edit($get, $post, $files);

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
        $get = $this->request->getGET();

        $this->service->delete($get);
    }

    public function block(): string
    {
        $get = $this->request->getGET();

        $this->service->block($get);

        return '';
    }

    public function unBlock(): string
    {
        $get = $this->request->getGET();

        $this->service->unBlock($get);

        return '';
    }

    public function search(): string
    {
        $post = $this->request->getPost();

        $params = $this->service->search($post);

        return $this->view->render('search', 'article', $params);
    }

}
