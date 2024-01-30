<?php

namespace app\Services\Articles\Repositories;

use app\Services\BaseRepository;
use Exception;

class DeleteArticleRepository extends BaseRepository
{
    public function delete(int $id): bool
    {
        try {
            $this->connection->beginTransaction();

            $query = 'DELETE from articles_categories where id_article=? limit 1';
            $this->connection->prepare($query)->execute([$id]);

            $query = 'DELETE from users_articles where id_article=? limit 1';
            $this->connection->prepare($query)->execute([$id]);

            $query = 'DELETE from articles where id=? limit 1';
            $this->connection->prepare($query)->execute([$id]);

            $this->connection->commit();

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getArticleById(int $id): array
    {
        $query = 'select is_active, is_blocked from articles where id=?';

        $this->connection->prepare($query)->execute([$id]);

        return $this->connection->fetch();
    }

    public function getAuthorOfArticle(int $id): array
    {
        $query = 'select * from users join users_articles on users.id = users_articles.id_user where users_articles.id_article=?';

        $this->connection->prepare($query)->execute([$id]);

        return $this->connection->fetch();
    }

}
