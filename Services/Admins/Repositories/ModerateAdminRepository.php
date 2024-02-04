<?php
declare(strict_types=1);

namespace app\Services\Admins\Repositories;

use app\Services\BaseRepository;

class ModerateAdminRepository extends BaseRepository
{
    public function getItemsByIds(string $page, array $ids, string $mode)
    {
        $placeholders = \rtrim(\str_repeat('?,', \count($ids)), ',');
        $query = 'SELECT * FROM ' . $page . ' WHERE id IN (' . $placeholders . ') ORDER BY created_at ' . $mode;

        $this->connection->prepare($query)->execute([...$ids]);

        return $this->connection->fetchAll();
    }

}
