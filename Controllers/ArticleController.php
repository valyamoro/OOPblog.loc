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

        $data = $this->service->show($get, self::PER_PAGE);

        return $this->view->render('show', 'article', $data);
    }

    public function add(): string
    {
        $post = $this->request->getPost();
        $files = $this->request->getFiles();

        $result = $this->service->add($post, $files);

        return $this->view->render('add', 'article', $result);
    }

    public function edit(): string
    {
        $get = $this->request->getGET();
        $post = $this->request->getPost();
        $files = $this->request->getFiles();

        $result = $this->service->edit($get, $post, $files);

        return $this->view->render('edit', 'article', $result);
    }

    public function category(): string
    {
        $result = $this->service->getCategoryArticles($this->request, self::PER_PAGE);

        return $this->view->render('category', 'article', $result);
    }

    public function delete(): void
    {
        $get = $this->request->getGET();

        $this->service->delete($get);
    }

    public function block(): void
    {
        $get = $this->request->getGET();

        $this->service->block($get);
    }

    public function unBlock(): void
    {
        $get = $this->request->getGET();

        $this->service->unBlock($get);
    }

    public function search(): string
    {
        $post = $this->request->getPost();

        $result = $this->service->search($post);

        return $this->view->render('search', 'article', $result);
    }

}
