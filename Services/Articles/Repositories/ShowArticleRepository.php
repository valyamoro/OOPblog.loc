<?php

namespace app\Services\Articles\Repositories;

use app\Services\BaseRepository;

class ShowArticleRepository extends BaseRepository
{
    public function getById(int $id): array
    {
        $query = 'select * from articles where id=? limit 1';

        $this->connection->prepare($query)->execute([$id]);

        return $this->connection->fetch();
    }

}
