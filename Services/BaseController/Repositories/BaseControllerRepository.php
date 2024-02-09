<?php
declare(strict_types=1);

namespace app\Services\BaseController\Repositories;

use app\Services\BaseRepository;

class BaseControllerRepository extends BaseRepository
{
    public function getAllCategories()
    {
        $query = 'select * from categories';

        $this->connection->prepare($query)->execute();

        return $this->connection->fetchAll();
    }

}
