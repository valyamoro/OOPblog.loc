<?php
declare(strict_types=1);

namespace app\Services\Admins;

use app\Services\BaseService;

class ApproveAdminService extends BaseService
{
    public function approve(string $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['user']['role'] !== '0') {
            if ($this->repository->approve((int)$id)) {
                $_SESSION['success'] = 'The article has been successfully approved!' . "\n";
            } else {
                $_SESSION['warning'] = 'The article was`nt approved!' . "\n";
            }

            \header("Location: {$_SERVER['HTTP_REFERER']}");
        } else {
            \header('Location: /articles');
        }
    }
}
