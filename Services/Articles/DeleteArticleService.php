<?php

namespace app\Services\Articles;

use app\Models\ArticleModel;
use app\Services\BaseService;

class DeleteArticleService extends BaseService
{
    public function delete(int $id): void
    {
        if (empty($_SESSION['user'])) {
            $_SESSION['warning'] = 'You are not logged in, please log in.' . "\n";
            \header('Location: /users/auth');
        }

        $result = $this->repository->getArticleById($id);

        if ($result['is_active'] === 0) {
            $_SESSION['message'] = 'This article is under review!' . "\n";
            \header('Location: /');
        }

        if ($result['is_blocked'] === 1) {
            $_SESSION['message'] = 'This article is under block!' . "\n";
            \header('Location: /');
        }

        $result = $this->repository->getAuthorOfArticle($id);

        if ($_SESSION['user']['id'] !== (int)$result['id_user'] && $_SESSION['user']['role'] !== '1') {
            $_SESSION['message'] = 'This isn`t your article!' . "\n";
            \header('Location: /');
        } else {
            $imagePath = $this->repository->getImageById($id);

            if (!empty($imagePath)) {
                unlink(__DIR__ . '\..\\' .  $imagePath);
            }
            $this->repository->delete($id);
            $this->repository->deleteArticlesCategories($id);
            $this->repository->deleteUsersArticles($id);
            $_SESSION['success'] = 'You are success deleted your article!' . "\n";

            \header('Location: /');
        }
    }

}
