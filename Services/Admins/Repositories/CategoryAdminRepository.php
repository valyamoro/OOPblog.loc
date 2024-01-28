<?php

namespace app\Services\Admins\Repositories;

use app\Services\BaseRepository;

class CategoryAdminRepository extends BaseRepository
{
    public function add(array $data): bool
    {
        $query = 'insert into categories (title, id_parent) values (?, ?)';

        $this->connection->prepare($query)->execute(\array_values($data));

        return (bool)$this->connection->rowCount();
    }

    public function getCategories(): array
    {
        $query = 'select * from categories';

        $this->connection->prepare($query)->execute();

        return $this->connection->fetchAll();
    }

}
