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
            $article = new ArticleModel(...$data);
            $article->validator->setRules($article->rules());

            if (!$article->validator->validate($article)) {
                $_SESSION['validate'] = $article->validator->errors;
            } else {
                $now = \date('Y-m-d H:i:s');
                $data = [
                    'title' => $data['title'],
                    'content' => $data['content'],
                    'is_active' => 0,
                    'is_blocked' => 0,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];

                if (!$this->repository->add($data)) {
                    $messages = 'Article was not added, please try more' . "\n";
                } else {
                    $_SESSION['success'] = 'Article was added!' . "\n";
                    \header('Location: /home');
                }
            }
        }

        return $messages;
    }


}
