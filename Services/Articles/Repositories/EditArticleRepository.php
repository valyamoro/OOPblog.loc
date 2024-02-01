<?php
declare(strict_types=1);

namespace app\Services\Articles\Repositories;

use app\Services\BaseRepository;

class EditArticleRepository extends BaseRepository
{
    public function getArticleById(int $id): array
    {
        $query = 'select * from articles
        join users_articles on articles.id = users_articles.id_article
        where articles.id=? limit 1';

        $this->connection->prepare($query)->execute([$id]);

        return $this->connection->fetch();
    }

    public function edit(array $data): bool
    {
        $query = 'update articles set title=?, content=?, is_active=?, image_path=?, updated_at=? where id=?';

        print_r($data);
        $this->connection->prepare($query)->execute($data);

        return (bool)$this->connection->rowCount();
    }

}
