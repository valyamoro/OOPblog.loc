<?php
declare(strict_types=1);

namespace app\Services;
use app\Database\PDODriver;

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

}
