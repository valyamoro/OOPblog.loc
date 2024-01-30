<?php
declare(strict_types=1);

namespace app\Services\Articles\Repositories;

use app\Services\BaseRepository;

class UnBlockArticleRepository extends BaseRepository
{
    public function unblock(int $id): bool
    {
        $query = 'update articles set is_blocked=0 where id=?';

        $this->connection->prepare($query)->execute([$id]);

        return (bool)$this->connection->rowCount();
    }

}
