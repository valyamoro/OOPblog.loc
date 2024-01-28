<?php
declare(strict_types=1);

namespace app\Services\Articles;

use app\Models\ArticleModel;
use app\Services\BaseService;

class EditArticleService extends BaseService
{
    public function edit(array $request): array
    {
        $messages = [];

        if (empty($_SESSION['user'])) {
            $_SESSION['warning'] = 'You are not logged in, please log in.' . "\n";
            \header('Location: /users/auth');
        }

        $result = $this->repository->getById((int)$request['get']['id']);

        if ($result['is_active'] === 0) {
            $_SESSION['message'] = 'This article is under review!' . "\n";
            \header('Location: /');
        }

        if ($result['is_blocked'] === 1) {
            $_SESSION['message'] = 'This article is under block!' . "\n";
            \header('Location: /');
        }

        $result = $this->repository->getAuthorOfArticle((int)$request['get']['id']);

        if ($_SESSION['user']['id'] !== (int)$result['id_user'] && $_SESSION['user']['role'] !== '1') {
            $_SESSION['message'] = 'This isn`t your article!' . "\n";
            \header('Location: /');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new ArticleModel(...$request['post']);
            $model->validator->setRules($model->rules());

            if (!$model->validator->validate($model)) {
                $messages = $model->validator->errors;
            } else {
                $imagePath = $this->repository->getImageById((int)$request['get']['id']);

                if (!empty($imagePath)) {
                    unlink(__DIR__ . '\..\\' .  $imagePath);
                }

                $imagePath = $this->repository->uploadImage($request['files']['image']);

                $data = [
                    'title' => $request['post']['title'],
                    'content' => $request['post']['content'],
                    'is_active' => 0,
                    'image_path' => $imagePath,
                    'updated_at' => \date('Y-m-d H:i:s'),
                ];

                if (!$this->repository->edit($data, (int)$request['get']['id'])) {
                    $_SESSION['message'] = 'Article was not edited, please try more' . "\n";
                } else {
                    $_SESSION['success'] = 'Article was edited!' . "\n";
                    \header('Location: /');
                }
            }
        }

        return $messages;
    }

}
