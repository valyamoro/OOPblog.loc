<?php
declare(strict_types=1);

namespace app\Services\Article;

use app\Models\ArticleModel;
use app\Services\BaseService;

class EditArticleService extends BaseService
{
    public function edit(array $get, array $post, array $files): array
    {
        $result = [];

        if (empty($_SESSION['user'])) {
            $_SESSION['warning'] = 'You are not logged in, please log in.' . "\n";
            \header('Location: /users/auth');
        }

        $result['article'] = $this->repository->getArticleById((int)$get['id']);

        if ($result['article']['is_active'] === 0) {
            $_SESSION['message'] = 'This article is under review!' . "\n";
            \header('Location: /');
        }

        $_SESSION['default_value']['title'] = $result['article']['title'];
        $_SESSION['default_value']['content'] = $result['article']['content'];

        if ($result['article']['is_blocked'] === 1) {
            $_SESSION['message'] = 'This article is under block!' . "\n";
            \header('Location: /');
        }

        if ($_SESSION['user']['id'] !== (int)$result['article']['id_user'] && $_SESSION['user']['role'] !== '1') {
            $_SESSION['message'] = 'This isn`t your article!' . "\n";
            \header('Location: /');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dataModel = $this->formatArticleDataForModel($post, $files);
            $model = new ArticleModel(...$dataModel);
            $model->validator->setRules($model->rules());

            if (!$model->validator->validate($model)) {
                $result['validate'] = $model->validator->errors;
            } else {
                $data = $this->formatArticleData($post, $get, $files);

                $imagePath = $this->repository->getImageById((int)$get['id']);
                if (!empty($request['files']['image']['tmp_name'])) {
                    \unlink(__DIR__ . '\..\\' . $imagePath);
                }

                $data = [...$data, (int)$get['id']];
                if (!$this->repository->edit($data)) {
                    $_SESSION['message'] = 'Article was not edited, please try more' . "\n";
                } else {
                    $_SESSION['success'] = 'Article was edited!' . "\n";
                    \header('Location: /');
                }
            }
        }

        return $result;
    }

    private function formatArticleData(array $get, array $post, array $files): array
    {
        if (!empty($request['files']['image']['tmp_name'])) {
            $imagePath = $this->repository->uploadImage($files['image']);
        } else {
            $imagePath = $this->repository->getImageById((int)$get['id']);
        }

        $now = \date('Y-m-d H:i:s');

        return [
            $post['title'],
            $post['content'],
            0,
            $imagePath,
            $now,
        ];
    }

}
