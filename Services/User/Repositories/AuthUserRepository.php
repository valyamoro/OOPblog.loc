<?php
declare(strict_types=1);

namespace app\Services\User\Repositories;

use app\Services\BaseRepository;

class AuthUserRepository extends BaseRepository
{
    public function getByEmail(string $email): array
    {
        $query = 'select * from users where email=?';

        $this->connection->prepare($query)->execute([$email]);

        return $this->connection->fetch();
    }

}
