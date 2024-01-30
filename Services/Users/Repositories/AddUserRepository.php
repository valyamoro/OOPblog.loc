<?php
declare(strict_types=1);

namespace app\Services\Users\Repositories;

use app\Services\BaseRepository;

class AddUserRepository extends BaseRepository
{
    public function add(array $data): bool
    {
        $query = 'insert into users (firstName, lastName, patronymic, email, phone, password, is_bann, role, created_at, updated_at) 
        values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

        $this->connection->prepare($query)->execute(\array_values($data));

        return (bool)$this->connection->lastInsertId();
    }

    public function getByEmail(string $value): bool
    {
        $query = 'select id from users where email=?';

        $this->connection->prepare($query)->execute([$value]);

        return (bool)$this->connection->fetch();
    }

}
