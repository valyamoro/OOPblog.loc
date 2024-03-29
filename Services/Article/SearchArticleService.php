<?php
declare(strict_types=1);

namespace app\Services\Article;

use app\Models\SearchModel;
use app\Services\BaseService;

class SearchArticleService extends BaseService
{
    public function search(): array
    {
        $result['articles'] = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $post = $this->request->getPost();
            $model = new SearchModel($post['search']);
            $model->validator->setRules($model->rules());

            if (!$model->validator->validate($model)) {
                $_SESSION['validate']['search'] = $model->validator->errors;
            } else {
                $search = '%' . $post['search'] . '%';
                $result['articles'] = $this->repository->getAllCategoriesBySearch($search);

                if (empty($result['articles'])) {
                    $result['warning'] = 'There are no such articles!' . "\n";
                }
            }
        } else {
            \header('Location: /');
        }

        return $result;
    }

}
