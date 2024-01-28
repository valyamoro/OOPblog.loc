<?php

namespace app\Services\Articles\Repositories;

use app\Services\BaseRepository;

class DeleteArticleRepository extends BaseRepository
{
    public function delete(int $id): bool
    {
        $query = 'DELETE from articles where id=?';

        $this->connection->prepare($query)->execute([$id]);

        return (bool)$this->connection->rowCount();
    }

    public function deleteArticlesCategories(int $id): bool
    {
        $query = 'DELETE from articles_categories where id_article=?';

        $this->connection->prepare($query)->execute([$id]);

        return (bool)$this->connection->rowCount();
    }

    public function deleteUsersArticles(int $id): bool
    {
        $query = 'DELETE from users_articles where id_article=?';

        $this->connection->prepare($query)->execute([$id]);

        return (bool)$this->connection->rowCount();
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
