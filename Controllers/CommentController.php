<?php

namespace app\Controllers;

use app\core\Controller;

class CommentController extends Controller
{
    public function add(): void
    {
        $request = $this->request->getPost();
        $this->service->add($request);
    }

}
