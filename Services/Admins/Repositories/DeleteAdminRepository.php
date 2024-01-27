<?php
declare(strict_types=1);

namespace app\Services\Admins\Repositories;

use app\Services\BaseRepository;

class DeleteAdminRepository extends BaseRepository
{
    public function delete(int $id): bool
    {
        $query = 'delete from articles where id=?';

        $this->connection->prepare($query)->execute([$id]);

        return (bool)$this->connection->rowCount();
    }

    public function deleteUsersArticles(int $id): bool
    {
        $query = 'delete from users_articles where id_article=?';

        $this->connection->prepare($query)->execute([$id]);

        return (bool)$this->connection->rowCount();
    }

}
