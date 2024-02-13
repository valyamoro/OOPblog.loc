<?php
declare(strict_types=1);

namespace app\Controllers;

class CommentController extends BaseController
{
    public function add(): string
    {
        $post = $this->request->getPost();

        $this->service->add($post);

        return '';
    }

    public function delete(): void
    {
        $get = $this->request->getGet();

        $this->service->delete($get);
    }

}
