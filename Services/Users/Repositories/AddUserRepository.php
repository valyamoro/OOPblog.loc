<?php
declare(strict_types=1);

namespace app\Services\Users\Repositories;

use app\Services\BaseRepository;

class AddUserRepository extends BaseRepository
{
    public function add($data): bool
    {
        $query = 'insert into users (firstName, lastName, patronymic, email, phone, password, is_bann, created_at, updated_at) 
        values (:firstName, :lastName, :patronymic, :email, :phone, :password, :is_bann, :created_at, :updated_at)';

        $this->connection->prepare($query)->execute([
            ':firstName' => $data['firstName'],
            ':lastName' => $data['lastName'],
            ':patronymic' => $data['patronymic'],
            ':email' => $data['email'],
            ':phone' => $data['phone'],
            ':password' => $data['password'],
            ':is_bann' => $data['is_bann'],
            ':created_at' => $data['created_at'],
            ':updated_at' => $data['updated_at'],
        ]);

        return (bool)$this->connection->lastInsertId();
    }

}
