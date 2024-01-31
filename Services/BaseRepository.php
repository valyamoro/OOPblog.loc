<?php
declare(strict_types=1);

namespace app\Services;
use app\core\Pagination;
use app\Database\PDODriver;
use Exception;

abstract class BaseRepository
{
    protected const TABLE_NAME = '';

    public function __construct(
        protected PDODriver $connection,
    ) {
    }

    public function uploadImage(array $data): string
    {
        $filePath = __DIR__ . '\..\uploads\\' . \uniqid() . $data['name'];

        \move_uploaded_file($data['tmp_name'], $filePath);

        return '\..\\' . \strstr($filePath, 'uploads');
    }

    public function getImageById(int $id): string
    {
        $query = 'select image_path from articles where id=?';

        $this->connection->prepare($query)->execute([$id]);

        return $this->connection->fetch()['image_path'];
    }

    public function deleteArticle(string $page, int $id): bool
    {
        try {
            $this->connection->beginTransaction();

            $query = 'DELETE from articles_categories where id_article=? limit 1';
            $this->connection->prepare($query)->execute([$id]);

            $query = 'DELETE from users_articles where id_article=? limit 1';
            $this->connection->prepare($query)->execute([$id]);

            $query = 'DELETE from articles where id=? limit 1';
            $this->connection->prepare($query)->execute([$id]);

            $this->connection->commit();

            return true;
        } catch (Exception $e) {
            $this->connection->rollBack();

            return false;
        }
    }

    public function deleteComment(string $page, int $id): bool
    {
        try {
            $this->connection->beginTransaction();

            $query = 'DELETE from users_comments where id_comment=? limit 1';
            $this->connection->prepare($query)->execute([$id]);

            $query = 'DELETE from comments where id=? limit 1';
            $this->connection->prepare($query)->execute([$id]);

            $this->connection->commit();

            return true;
        } catch (Exception $e) {
            $this->connection->rollBack();

            return false;
        }
    }

    public function getCount(string $item): int
    {
        $query = 'select count(id) from ' . $item . ' where is_active=1';

        $this->connection->prepare($query)->execute();

        return \array_values($this->connection->fetch())[0];
    }

    public function getAll(int $limit, int $offset, string $mode, string $item): array
    {
        $query = 'select * from ' . $item . ' where is_active=1 order by created_at ' . $mode . ' limit ' . $limit . ' offset ' . $offset;

        $this->connection->prepare($query)->execute();

        return $this->connection->fetchAll();
    }

}
