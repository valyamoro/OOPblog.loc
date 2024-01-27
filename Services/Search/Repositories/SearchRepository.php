<?php

namespace app\Services\Search\Repositories;

use app\Services\BaseRepository;

class SearchRepository extends BaseRepository
{
    public function search(string $value)
    {
        $query = "select id, title from articles where title like '%$value%'";

        $this->connection->prepare($query)->execute();

        return $this->connection->fetchAll();
    }

}
