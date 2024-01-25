<?php
declare(strict_types=1);

namespace app\Services\Home\Repositories;

use app\Services\BaseRepository;

class HomeRepository extends BaseRepository
{
    public function getAll(int $limit, int $offset, string $mode): array
    {
        $query = 'select * from articles order by created_at ' . $mode . ' limit ' . $limit . ' offset ' . $offset;

        $this->connection->prepare($query)->execute();

        return $this->connection->fetchAll();
    }

    public function getCount(): int
    {
        $query = 'select count(id) from articles';

        $this->connection->prepare($query)->execute();

        return \array_values($this->connection->fetch())[0];
    }

}
