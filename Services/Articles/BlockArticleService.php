<?php
declare(strict_types=1);

namespace app\Services\Articles;

use app\Services\BaseService;

class BlockArticleService extends BaseService
{
    public function block(int $id): void
    {
        if ($_SESSION['user']['role'] === '1') {
            if ($this->repository->block($id)) {
                $_SESSION['success'] = 'You are success blocked a article!' . "\n";
            } else {
                $_SESSION['warning'] = 'You are not a blocked article!' . "\n";
            }
        }
        \header('Location: /');
    }
}