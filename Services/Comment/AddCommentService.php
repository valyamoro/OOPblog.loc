<?php

namespace app\Services\Comment;

use app\Models\CommentModel;
use app\Services\BaseService;

class AddCommentService extends BaseService
{
    public function add(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $post = $this->request->getPost();
            $model = new CommentModel($post['content']);
            $model->validator->setRules($model->rules());

            if (!$model->validator->validate($model)) {
                $_SESSION['default_value']['comment'] = $post['content'];
                $_SESSION['validate'] = $model->validator->errors;
            } else {
                $post['id_user'] = $_SESSION['user']['id'];

                $data = $this->formatCommentData($post);
                $result = $this->repository->add($data);

                if (!$result) {
                    $_SESSION['warning'] = 'The comment was not delivered, please try again' . "\n";
                } else {
                    $_SESSION['success'] = 'You have successfully left a comment, please wait until it is published' . "\n";
                }
            }

            \header("Location: {$_SERVER['HTTP_REFERER']}");
        } else {
            \header('Location: /');
        }
    }

    private function formatCommentData(array $post): array
    {
        $now = \date('Y-m-d H:i:s');
        return [
            'content' => $post['content'],
            'id_article' => $post['id_article'],
            'is_active' => 0,
            'is_blocked' => 0,
            'id_user' => $post['id_user'],
            'created_at' => $now,
            'updated_at' => $now,
        ];
    }

}
