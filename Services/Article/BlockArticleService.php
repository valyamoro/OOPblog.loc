<?php
declare(strict_types=1);

namespace app\Services\Article;

use app\Services\BaseService;

class BlockArticleService extends BaseService
{
    public function block(array $get): void
    {
        if ($_SESSION['user']['role'] === '1') {
            if ($this->repository->block((int)$get['id'])) {
                $_SESSION['success'] = 'You are success blocked a article!' . "\n";
            } else {
                $_SESSION['warning'] = 'You are not a blocked article!' . "\n";
            }
        }
        \header('Location: /');
    }
}