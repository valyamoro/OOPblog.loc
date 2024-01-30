<?php
declare(strict_types=1);

namespace app\Services\Articles\Repositories;

use app\Services\BaseRepository;
use Exception;

class DeleteArticleRepository extends BaseRepository
{
    public function getArticleById(int $id): array
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

}
