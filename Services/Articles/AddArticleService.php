<?php

namespace app\Services\Articles;

use app\Models\ArticleModel;
use app\Services\BaseService;

class AddArticleService extends BaseService
{
    public function add(array $data): array
    {
        $messages = [];

        if (empty($_SESSION['user'])) {
            $_SESSION['warning'] = 'You are not logged in, please log in.' . "\n";
            \header('Location: /users/auth');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new ArticleModel(...$data['post']);
            $model->validator->setRules($model->rules());

            if (!$model->validator->validate($model)) {
                $messages = $model->validator->errors;
            } else {
                $now = \date('Y-m-d H:i:s');
                $data = [
                    $data['post']['title'],
                    $data['post']['content'],
                    0,
                    0,
                    $this->repository->uploadImage($data['files']['image']),
                    $now,
                    $now,
                ];

                if (!$this->repository->add($data)) {
                    $_SESSION['message'] = 'Article was not added, please try more' . "\n";
                } else {
                    $_SESSION['success'] = 'Article was added!' . "\n";
                    \header('Location: /articles');
                }
            }
        }

        return $messages;
    }


}
