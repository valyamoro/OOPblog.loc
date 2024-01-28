<?php

namespace app\Services\Search\Repositories;

use app\Services\BaseRepository;

class SearchRepository extends BaseRepository
{
    public function search(string $value)
    {
        $query = "select id, title from articles where title like :searchValue";

        $this->connection->prepare($query)->execute([
            ':searchValue' => '%' . $value . '%',
        ]);

        return $this->connection->fetchAll();
    }

}
