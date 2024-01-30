<?php
declare(strict_types=1);

namespace app\Services\Admins;

use app\Services\BaseService;

class UnBlockAdminService extends BaseService
{
    public function unBlock(array $request): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['user']['role'] !== '0') {
            if ($this->repository->unBlock((int)$request['id'])) {
                $_SESSION['success'] = 'The article has been successfully unblocked!' . "\n";
            } else {
                $_SESSION['warning'] = 'The article was not unblocked!' . "\n";
            }

            \header("Location: {$_SERVER['HTTP_REFERER']}");
        } else {
            \header('Location: /articles');
        }
    }

}
