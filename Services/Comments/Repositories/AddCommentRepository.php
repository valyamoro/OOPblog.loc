<?php
declare(strict_types=1);

namespace app\Services\Comments\Repositories;

use app\Services\BaseRepository;
use Exception;

class AddCommentRepository extends BaseRepository
{
    public function add(array $data): bool
    {
        try {
            $this->connection->beginTransaction();

            dump($data);
            $query = 'INSERT INTO comments (content, id_article, is_active, is_blocked, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)';
            $this->connection->prepare($query)->execute([$data['content'], $data['id_article'], $data['is_active'], $data['is_blocked'], $data['created_at'], $data['updated_at']]);

            $commentId = $this->connection->lastInsertId();

            $query = 'INSERT INTO users_comments (id_user, id_comment) VALUES (?, ?)';
            $this->connection->prepare($query)->execute([$data['id_user'], $commentId]);

            $this->connection->commit();

            return true;
        } catch (Exception $e) {
            $this->connection->rollBack();

            return false;
        }
    }

}