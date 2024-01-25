<?php
declare(strict_types=1);

namespace app\Services\Articles\Repositories;

use app\Services\BaseRepository;

class EditArticleRepository extends BaseRepository
{
    public function getById(int $id): array
    {
        $query = 'select is_active, is_blocked from articles where id=?';

        $this->connection->prepare($query)->execute([$id]);

        return $this->connection->fetch();
    }

    public function getAuthorOfArticle(int $id): array
    {
        $query = 'select * from users join users_articles on users.id = users_articles.id_user where users_articles.id_article=?';

        $this->connection->prepare($query)->execute([$id]);

        return $this->connection->fetch();
    }

    public function edit(array $data, int $id): bool
    {
        $query = 'update articles set title=?, content=?, is_active=?, updated_at=? where id=?';

        $data = [...$data, $id];

        $this->connection->prepare($query)->execute(array_values($data));

        return (bool)$this->connection->rowCount();
    }
}
