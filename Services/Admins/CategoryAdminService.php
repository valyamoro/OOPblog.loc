<?php

namespace app\Services\Admins;

use app\Services\BaseService;

class CategoryAdminService extends BaseService
{
    public function add(array $request): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $allCategories = $this->repository->getCategories();

            foreach ($allCategories as $item) {
                if ($item['title'] === $request['title']) {
                    $_SESSION['warning'] = 'This category already exist!' . "\n";
                    \header('Location: /admins/category');
                    die;
                }
            }

            $result = $this->repository->add($request);

            if (!$result) {
                $_SESSION['warning'] = 'Failed to add a new category' . "\n";
            } else {
                $_SESSION['success'] = 'You have successfully added a new category' . "\n";
            }
        }
    }

    public function getCategories()
    {
        return $this->repository->getCategories();
    }
}
