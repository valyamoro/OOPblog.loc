<?php
declare(strict_types=1);

namespace app\Controllers;

class CommentController extends BaseController
{
    public function add(): string
    {
        $request = $this->request->getPost();

        $this->service->add($request);

        return '';
    }

    public function delete(): string
    {
        $request = $this->request->getGet();

        $this->service->delete($request);

        return '';
    }

}
