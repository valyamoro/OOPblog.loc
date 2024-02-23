<?php
declare(strict_types=1);

namespace app\Controllers;

use app\Services\BaseController\BaseControllerService;
use app\Services\BaseController\Repositories\BaseControllerRepository;

class ArticleController extends BaseController
{
    public function show(): string
    {
        $data = $this->service->show(self::PER_PAGE);

        return $this->view->render('show', 'article', $data);
    }

    public function add(): string
    {
        $result = $this->service->add();

        return $this->view->render('add', 'article', $result);
    }

    public function edit(): string
    {
        $result = $this->service->edit();

        return $this->view->render('edit', 'article', $result);
    }

    public function category(): string
    {
        $result = $this->service->getCategoryArticles(self::PER_PAGE);

        return $this->view->render('category', 'article', $result);
    }

    public function delete(): void
    {
        $this->service->delete();
    }

    public function block(): void
    {
        $this->service->block();
    }

    public function unBlock(): void
    {
        $this->service->unBlock();
    }

    public function search(): string
    {
        $result = $this->service->search();

        return $this->view->render('search', 'article', $result);
    }

}
