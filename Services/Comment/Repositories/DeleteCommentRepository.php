<?php
declare(strict_types=1);

namespace app\Services\Comment\Repositories;

use app\Services\BaseRepository;

class DeleteCommentRepository extends BaseRepository
{
    public function getCommentById(int $id): array
    {
        $query = 'select * from comments 
        join users_comments on comments.id = users_comments.id_comment
        where users_comments.id_comment=? limit 1';

        $this->connection->prepare($query)->execute([$id]);

        return $this->connection->fetch();
    }

}