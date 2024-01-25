<?php

namespace app\Services\Articles\Repositories;

use app\Services\BaseRepository;

class AddArticleRepository extends BaseRepository
{
    public function add(array $data): bool
    {
        $query = 'insert into articles(title, content, is_active, is_blocked, created_at, updated_at) values (?, ?, ?, ?, ?, ?)';

        $this->connection->prepare($query)->execute(\array_values($data));

        return (bool)$this->connection->rowCount();
    }

}
