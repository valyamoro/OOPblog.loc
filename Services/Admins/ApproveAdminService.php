<?php
declare(strict_types=1);

namespace app\Services\Admins;

use app\Services\BaseService;

class ApproveAdminService extends BaseService
{
    public function approve(array $request): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['user']['role'] !== '0') {
            $page = \rtrim($request['item'], 's');
            if ($this->repository->approve($request['item'], (int)$request['id'])) {
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
