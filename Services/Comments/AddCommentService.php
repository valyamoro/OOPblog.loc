<?php

namespace app\Services\Comments;

use app\Models\CommentModel;
use app\Services\BaseService;

class AddCommentService extends BaseService
{
    public function add(array $request): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new CommentModel($request['content']);
            $model->validator->setRules($model->rules());

            if (!$model->validator->validate($model)) {
                $_SESSION['default_value']['content'] = $request['content'];
                $_SESSION['validate'] = $model->validator->errors;
            } else {
                $request['id_user'] = $_SESSION['user']['id'];

                $result = $this->repository->add($request);
                if (!$result) {
                    $_SESSION['warning'] = 'The comment was not delivered, please try again' . "\n";
                } else {
                    $_SESSION['success'] = 'You have successfully left a comment!' . "\n";
                }
            }
            \header("Location: {$_SERVER['HTTP_REFERER']}");
        } else {
            \header('Location: /');
        }
    }

}
