<?php
declare(strict_types=1);

namespace app\Services\Admins;

use app\Services\BaseService;

class DeleteAdminService extends BaseService
{
    public function delete(array $get): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['user']['role'] === '1') {
            $page = \rtrim($get['item'], 's');
            $method = 'delete' . $page;
            echo $method;
            if ($this->repository->$method((int)$get['id'])) {
                $_SESSION['success'] = "The {$page} has been successfully deleted!\n";
            } else {
                $_SESSION['warning'] = "The {$page} was not deleted!\n";
            }

            \header("Location: {$_SERVER['HTTP_REFERER']}");
        } else {
            \header('Location: /articles');
        }
    }

}
