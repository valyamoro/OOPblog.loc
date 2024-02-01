<?php
declare(strict_types=1);

namespace app\Controllers;

class CommentController extends BaseController
{
    public function add(): void
    {
        $request = $this->request->getPost();

        $this->service->add($request);
    }

}
