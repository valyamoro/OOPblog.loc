<?php
declare(strict_types=1);

namespace app\Services\Admins\Repositories;

use app\Services\BaseRepository;

class ModerateAdminRepository extends BaseRepository
{
    public function getAll(string $page): array
    {
        $query = 'select * from ' . $page . ' where is_active=0';

        $this->connection->prepare($query)->execute();

        return $this->connection->fetchAll();
    }

}
