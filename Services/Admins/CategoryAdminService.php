<?php

namespace app\Services\Admins;

use app\Models\CategoryModel;
use app\Services\BaseService;

class CategoryAdminService extends BaseService
{
    public function add(array $request): array
    {
        $result = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new CategoryModel($request['title']);
            $model->validator->setRules($model->rules());

            if (!$model->validator->validate($model)) {
                $result['validate'] = $model->validator->errors;
            } else {
                $allCategories = $this->repository->getCategories();

                foreach ($allCategories as $item) {
                    if ($item['title'] === $request['title']) {
                        $result['warning'] = 'This category already exist!' . "\n";
                        break;
                    }
                }

                if (empty($result['warning'])) {
                    if (!$this->repository->add($request)) {
                        \header('Location: /admins/category?category_added=false');
                    } else {
                        \header('Location: /admins/category?category_added=true');
                    }
                }
            }
        }

        return $result;
    }

    public function getCategories(): array
    {
        return $this->repository->getCategories();
    }

}
