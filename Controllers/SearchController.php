<?php

namespace app\Controllers;

use app\core\Controller;

class SearchController extends Controller
{
    public function search(): string
    {
        $request = $this->request->getPost();

        $result['articles'] = $this->service->search($request['search']);

        return $this->view->render('search', 'article', $result);
    }

}
