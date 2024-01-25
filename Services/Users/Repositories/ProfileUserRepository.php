<?php

namespace app\Services\Users\Repositories;

use app\Services\BaseRepository;

class ProfileUserRepository extends BaseRepository
{
    public function getArticlesById(int $id): array
    {
        $query = 'SELECT articles.* FROM users_articles
        JOIN articles ON users_articles.id_article = articles.id
        WHERE users_articles.id_user=?';

        $this->connection->prepare($query)->execute([$id]);

        return $this->connection->fetchAll();
    }
    public function getUserById(int $id): array
    {
        $query = 'select * from users where id=?';

        $this->connection->prepare($query)->execute([$id]);

        return $this->connection->fetch();
    }

}
