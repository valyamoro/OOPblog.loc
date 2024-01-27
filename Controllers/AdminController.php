<?php

namespace app\Controllers;

use app\core\Controller;

class AdminController extends Controller
{
    public function moderate(string $view, string $layout, array $params = []): string
    {
        $request = $this->request->getGET();

        $data = $this->service->getAll($request['page']);

        return $this->view->render($view, $layout, $data);
    }

    public function delete(): void
    {
        $request = $this->request->getGET();
        $this->service->delete($request['id']);
    }

    public function approve(): void
    {
        $request = $this->request->getGET();
        $this->service->approve($request['id']);
    }

}
