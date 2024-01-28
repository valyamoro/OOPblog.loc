<?php
declare(strict_types=1);

namespace app\Services\Articles\Repositories;

use app\Services\BaseRepository;

class BlockArticleRepository extends BaseRepository
{
    public function block(int $id): bool
    {
        $query = 'update articles set is_blocked=1 where id=?';

        $this->connection->prepare($query)->execute([$id]);

        return (bool)$this->connection->rowCount();
    }

}
