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

            $query = 'INSERT INTO comments (content, id_article) VALUES (?, ?)';
            $this->connection->prepare($query);
            $this->connection->execute([$data['content'], $data['id_article']]);

            $commentId = $this->connection->lastInsertId();

            $query = 'INSERT INTO users_comments (id_user, id_comment) VALUES (?, ?)';
            $stmtUsersComments = $this->connection->prepare($query);
            $stmtUsersComments->execute([$data['id_user'], $commentId]);

            $this->connection->commit();

            return true;
        } catch (Exception $e) {
            // Если что-то пошло не так, откатываем транзакцию
            $this->connection->rollBack();
            return false;
        }
    }

}