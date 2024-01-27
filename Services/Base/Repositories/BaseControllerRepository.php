<?php
declare(strict_types=1);

namespace app\Services\Base\Repositories;

use app\Services\BaseRepository;

class BaseControllerRepository extends BaseRepository
{
    public function getAll()
    {
        $query = 'select * from categories';

        $this->connection->prepare($query)->execute();

        return $this->connection->fetchAll();
    }

}
