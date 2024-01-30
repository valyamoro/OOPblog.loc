<?php
declare(strict_types=1);

namespace app\Controllers;

class SearchController extends BaseController
{
    public function search(): string
    {
        $request = $this->request->getPost();

        $result = $this->service->search($request);

        return $this->view->render('search', 'article', $result);
    }

}
