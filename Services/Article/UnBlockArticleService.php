<?php
declare(strict_types=1);

namespace app\Services\Article;

use app\Services\BaseService;

class UnBlockArticleService extends BaseService
{
    public function unBlock(array $get): void
    {
        if ($_SESSION['user']['role'] === '1') {
            if ($this->repository->unBlock((int)$get['id'])) {
                $_SESSION['success'] = 'You are success unblocked a article!' . "\n";
            } else {
                $_SESSION['warning'] = 'You are not a unblocked article!' . "\n";
            }
        }

        \header('Location: /');
    }

}
