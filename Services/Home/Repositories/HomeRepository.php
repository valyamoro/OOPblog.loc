<?php
declare(strict_types=1);

namespace app\Services\Home\Repositories;

use app\Services\BaseRepository;

class HomeRepository extends BaseRepository
{

    public function getCommentsById(int $id): array
    {
        $query = 'select * from comments where id_article=?';

        $this->connection->prepare($query)->execute([$id]);

        return $this->connection->fetchAll();
    }

}
