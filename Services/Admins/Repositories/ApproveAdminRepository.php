<?php
declare(strict_types=1);

namespace app\Services\Admins\Repositories;

use app\Services\BaseRepository;

class ApproveAdminRepository extends BaseRepository
{
    public function approve(string $page, int $id): bool
    {
        $query = 'update ' . $page . ' set is_active=1 where id=?';

        $this->connection->prepare($query)->execute([$id]);

        return (bool)$this->connection->rowCount();
    }

}
