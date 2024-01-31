<?php

namespace app\Services\Admins;

use app\Services\BaseService;

class CategoryAdminService extends BaseService
{
    public function add(array $request): array
    {
        $result = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $allCategories = $this->repository->getCategories();

            foreach ($allCategories as $item) {
                if ($item['title'] === $request['title']) {
                    $result['warning'] = 'This category already exist!' . "\n";
                    break;
                }
            }

            $action = $this->repository->add($request);

            if (!$action) {
                \header('Location: /admins/category?category_added=false');
            } else {
                \header('Location: /admins/category?category_added=true');
            }
        }

        return $result;
    }

    public function getCategories(): array
    {
        return $this->repository->getCategories();
    }

}
