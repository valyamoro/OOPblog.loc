<?php

namespace app\Services\Comments;

use app\Models\CommentModel;
use app\Services\BaseService;

class AddCommentService extends BaseService
{
    public function add(array $data): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new CommentModel($data['content']);
            $model->validator->setRules($model->rules());

            if (!$model->validator->validate($model)) {
                $_SESSION['validate'] = $model->validator->errors;
            } else {
                $idArticle = $this->repository->add($data);

                $warning = 'The comment was not delivered, please try again' . "\n";
                if ($idArticle === 0) {
                    $_SESSION['warning'] = $warning;
                } else {
                    if (!$this->repository->addUserComments((int)$_SESSION['user']['id'], $idArticle)) {
                        $_SESSION['warning'] = $warning;
                    } else {
                        $_SESSION['success'] = 'You have successfully left a comment!' . "\n";
                    }
                }
            }
        }
    }

}
