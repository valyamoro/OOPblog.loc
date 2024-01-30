<?php
declare(strict_types=1);

namespace app\Services\Articles\Repositories;

use app\Services\BaseRepository;
use Exception;

class AddArticleRepository extends BaseRepository
{
    public function add(array $data, int $categoryId): bool
    {
        try {
            $this->connection->beginTransaction();

            $query = 'insert into articles(title, content, is_active, is_blocked, image_path, created_at, updated_at) values (?, ?, ?, ?, ?, ?, ?)';
            $this->connection->prepare($query)->execute($data);

            $articleId = $this->connection->lastInsertId();

            $query = 'insert into users_articles (id_user, id_article) values (?, ?)';
            $this->connection->prepare($query)->execute([$_SESSION['user']['id'], $articleId]);

            $query = 'insert into articles_categories (id_article, id_category) values (?, ?)';
            $this->connection->prepare($query)->execute([$articleId, $categoryId]);

            $this->connection->commit();

            return true;
        } catch (Exception $e) {
            $this->connection->rollBack();

            return false;
        }
    }

    public function getCategories(): array
    {
        $query = 'select * from categories';

        $this->connection->prepare($query)->execute();

        return $this->connection->fetchAll();
    }

}
