<?php
declare(strict_types=1);

namespace app\Services\Admin;

use app\Services\BaseService;

class ApproveAdminService extends BaseService
{
    public function approve(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['user']['role'] !== '0') {
            $get = $this->request->getGET();

            $page = \rtrim($get['item'], 's');
            if ($this->repository->approve($get['item'], (int)$get['id'])) {
                $_SESSION['success'] = "The {$page} successfully approved!\n";
            } else {
                $_SESSION['warning'] = "The {$page} was not approved!\n";
            }

            \header("Location: {$_SERVER['HTTP_REFERER']}");
        } else {
            \header('Location: /articles');
        }
    }

}
