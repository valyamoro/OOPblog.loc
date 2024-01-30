<?php
declare(strict_types=1);

namespace app\Services\Admins;

use app\Services\BaseService;

class DeleteAdminService extends BaseService
{
    public function delete(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['user']['role'] !== '0') {
            $warning = 'The article was`nt deleted!' . "\n";

            if ($this->repository->delete($id)) {
                if ($this->repository->deleteUsersArticles($id)) {
                    $_SESSION['success'] = 'The article has been successfully deleted!' . "\n";
                } else {
                    $_SESSION['warning'] = $warning;
                }
            } else {
                $_SESSION['warning'] = $warning;
            }

            \header("Location: {$_SERVER['HTTP_REFERER']}");
        } else {
            \header('Location: /articles');
        }
    }

}
