<?php

namespace app\Controllers;

use app\core\Controller;

class ArticleController extends Controller
{
    public function index(string $view, array $params = []): string
    {
        $request = $this->request->getGET();

        $data['article'] = $this->service->show($request['id']);

        return $this->view->render($view, $data);
    }

}
