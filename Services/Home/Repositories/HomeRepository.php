<?php
declare(strict_types=1);

namespace app\Services\Home\Repositories;

use app\Services\BaseRepository;

class HomeRepository extends BaseRepository
{
    public function getAll(int $limit, int $offset, string $mode): array
    {
        $query = 'select * from articles where is_active=1 order by created_at ' . $mode . ' limit ' . $limit . ' offset ' . $offset;

        $this->connection->prepare($query)->execute();

        return $this->connection->fetchAll();
    }

    public function getCount(): int
    {
        $query = 'select count(id) from articles';

        $this->connection->prepare($query)->execute();

        return \array_values($this->connection->fetch())[0];
    }

    public function getCommentsById(int $id): array
    {
        $query = 'select * from comments where id_article=?';

        $this->connection->prepare($query)->execute([$id]);

        return $this->connection->fetchAll();
    }

    public function getCategories(): array
    {
        $query = 'select * from categories';

        $this->connection->prepare($query)->execute();

        return $this->connection->fetchAll();
    }

}
