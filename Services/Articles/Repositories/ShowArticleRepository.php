<?php

namespace app\Services\Articles\Repositories;

use app\Services\BaseRepository;

class ShowArticleRepository extends BaseRepository
{
    public function getById(int $id): array
    {
        $query = 'SELECT * FROM users_articles
        JOIN users ON users_articles.id_user = users.id
        JOIN articles ON users_articles.id_article=articles.id
        WHERE users_articles.id_article=?';

        $this->connection->prepare($query)->execute([$id]);

        return $this->connection->fetch();
    }

    public function getCommentsById(int $id): array
    {
        $query = 'SELECT * FROM comments JOIN
        users_comments ON comments.id = users_comments.id_comment JOIN
        users ON users_comments.id_user = users.id WHERE comments.id_article=?;';

        $this->connection->prepare($query)->execute([$id]);

        return $this->connection->fetchAll();
    }

}
