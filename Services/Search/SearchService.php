<?php

namespace app\Services\Search;

use app\Models\SearchModel;
use app\Services\BaseService;

class SearchService extends BaseService
{
    public function search(array $value): array
    {
        $result = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new SearchModel($value['search']);
            $model->validator->setRules($model->rules());

            if (!$model->validator->validate($model)) {
                $_SESSION['warning'] = $model->validator->errors;
            }

            $result['articles'] = $this->repository->search($value['search']);

            if (empty($result['articles'])) {
                $result['warning'] = 'There are no such articles!' . "\n";
            }
        } else {
            \header('Location: /');
        }

        return $result;
    }

}
