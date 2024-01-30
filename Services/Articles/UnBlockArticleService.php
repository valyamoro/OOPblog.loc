<?php

namespace app\Services\Articles;

use app\Services\BaseService;

class UnBlockArticleService extends BaseService
{
    public function unBlock(array $request): void
    {
        if ($_SESSION['user']['role'] === '1') {
            if ($this->repository->unBlock((int)$request['id'])) {
                $_SESSION['success'] = 'You are success unblocked a article!' . "\n";
            } else {
                $_SESSION['warning'] = 'You are not a unblocked article!' . "\n";
            }
        }
        \header('Location: /articles');
    }

}