<?php
declare(strict_types=1);

namespace app\Services\Users\Repositories;

use app\Services\BaseRepository;

class ProfileUserRepository extends BaseRepository
{
    public function getUserArticlesIds(int $limit, int $offset, string $mode, string $item, string $condition, array $params = []): array
    {
        $query = "SELECT * FROM articles 
        JOIN users_articles ON users_articles.id_article = articles.id
        WHERE {$condition} order by created_at {$mode} limit {$limit} offset {$offset}";

        $this->connection->prepare($query)->execute([$params[0]]);

        return $this->connection->fetchAll();
    }

    public function getUserById(int $id): array
    {
        $query = 'select * from users where id=?';

        $this->connection->prepare($query)->execute([$id]);

        return $this->connection->fetch();
    }

    public function getCountUserArticles(int $id)
    {
        $query = 'SELECT count(id_article) FROM users_articles
        JOIN articles ON users_articles.id_article = articles.id
        WHERE users_articles.id_user=?';

        $this->connection->prepare($query)->execute([$id]);

        return \array_values($this->connection->fetch())[0];
    }

}
