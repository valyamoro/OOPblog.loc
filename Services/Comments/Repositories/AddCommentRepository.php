<?php

namespace app\Services\Comments\Repositories;

use app\Services\BaseRepository;

class AddCommentRepository extends BaseRepository
{
    public function addUserComments(int $userId, int $articleId): bool
    {
        $query = 'insert into users_comments (id_user, id_comment) values (?, ?)';

        $this->connection->prepare($query)->execute([$userId, $articleId]);

        return (bool)$this->connection->rowCount();
    }

    public function add(array $data): int
    {
        $query = 'insert into comments (content, id_article) values (?, ?)';

        $this->connection->prepare($query)->execute(\array_values($data));

        return $this->connection->lastInsertId();
    }

}