<?php
declare(strict_types=1);

namespace app\Services\Admins;

use app\Services\BaseService;

class DeleteAdminService extends BaseService
{
    public function delete(array $request): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['user']['role'] !== '0') {
            if ($this->repository->deleteArticle((int)$request['id'])) {
                $_SESSION['success'] = 'The article has been successfully deleted!' . "\n";
            } else {
                $_SESSION['warning'] = 'The article was not deleted!' . "\n";;
            }

            \header("Location: {$_SERVER['HTTP_REFERER']}");
        } else {
            \header('Location: /articles');
        }
    }

}
