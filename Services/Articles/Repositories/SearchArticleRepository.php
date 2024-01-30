<?php

namespace app\Services\Articles\Repositories;

use app\Services\BaseRepository;

class SearchArticleRepository extends BaseRepository
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
