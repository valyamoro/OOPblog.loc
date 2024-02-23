<?php
declare(strict_types=1);

namespace app\Controllers;

class CommentController extends BaseController
{
    public function add(): string
    {
        $this->service->add();

        return '';
    }

    public function delete(): void
    {
        $this->service->delete();
    }

}
