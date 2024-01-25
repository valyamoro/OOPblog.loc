<?php
declare(strict_types=1);

namespace app\Services\Users\Repositories;

use app\Services\BaseRepository;

class AddUserRepository extends BaseRepository
{
    public function add($data): bool
    {
        $query = 'insert into users (firstName, lastName, patronymic, email, phone, password, is_bann, created_at, updated_at) 
        values (?, ?, ?, ?, ?, ?, ?, ?, ?)';

        $this->connection->prepare($query)->execute(\array_values($data));

        return (bool)$this->connection->lastInsertId();
    }

}
