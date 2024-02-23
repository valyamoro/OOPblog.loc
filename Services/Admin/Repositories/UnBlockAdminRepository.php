<?php
declare(strict_types=1);

namespace app\Services\Admin\Repositories;

use app\Services\BaseRepository;

class UnBlockAdminRepository extends BaseRepository
{
    public function unBlock(int $id): bool
    {
        $query = 'update articles set is_blocked=0 where id=?';

        $this->connection->prepare($query)->execute([$id]);

        return (bool)$this->connection->rowCount();
    }

}