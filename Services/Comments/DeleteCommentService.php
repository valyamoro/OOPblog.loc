<?php
declare(strict_types=1);

namespace app\Services\Comments;

use app\Services\BaseService;

class DeleteCommentService extends BaseService
{
    public function delete(array $request): void
    {
        if (!empty($_SESSION['user'])) {
            dump($request);
            $result = $this->repository->getCommentById((int)$request['id']);

            $userId = $_SESSION['user']['id'];
            if (($result['id_user'] !== $userId) && ($_SESSION['user']['role'] === '0')) {
                $_SESSION['message'] = 'You are not author this comment!' . "\n";
                \header("Location: {$_SERVER['HTTP_REFERER']}");
            } else {
                $action = $this->repository->deleteComment($result['id_comment']);
                if (!$action) {
                    $_SESSION['message'] = 'You are not deleted comment!' . "\n";
                } else {
                    $_SESSION['success'] = 'You are successful deleted comment!' . "\n";
                }

                \header("Location: {$_SERVER['HTTP_REFERER']}");
            }
        } else {
            \header('Location: /articles');
        }
    }

}