<?php
declare(strict_types=1);

namespace app\Services\Articles;

use app\Models\ArticleModel;
use app\Services\BaseService;

class AddArticleService extends BaseService
{
    public function add(array $request): array
    {
        $result = [];

        if (empty($_SESSION['user'])) {
            $_SESSION['warning'] = 'You are not logged in, please log in.' . "\n";
            \header('Location: /users/auth');
        }

        $result['categories'] = $this->repository->getCategories();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($request['post']['id_category'] === '0') {
                $result['validate']['option'] = 'Please make a choice!' . "\n";
            } else {
                $idCategory = (int)\array_pop($request['post']);
                $model = new ArticleModel(...$request['post']);
                $model->validator->setRules($model->rules());

                if (!$model->validator->validate($model)) {
                    $result['validate'] = $model->validator->errors;
                } else {
                    $data = $this->formatArticleData($request);
                    if (!$this->repository->add($data, $idCategory)) {
                        $_SESSION['message'] = 'Article was not added, please try more' . "\n";
                    } else {
                        $_SESSION['success'] = 'The article was successfully added and appeared on the review page, please wait until it is published' . "\n";
                        \header('Location: /articles');
                    }
                }
            }
        }

        return $result;
    }

    public function formatArticleData(array $data): array
    {
        $now = \date('Y-m-d H:i:s');

        return [
            $data['post']['title'],
            $data['post']['content'],
            0,
            0,
            $this->repository->uploadImage($data['files']['image']),
            $now,
            $now,
        ];
    }

}
