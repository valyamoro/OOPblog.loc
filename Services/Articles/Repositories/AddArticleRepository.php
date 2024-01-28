<?php

namespace app\Services\Articles\Repositories;

use app\Services\BaseRepository;

class AddArticleRepository extends BaseRepository
{
    public function addItems(array $data): bool
    {
        $query = 'insert into users_articles(id_user, id_article) values (?, ?)';

        $idArticle = $this->addItem($data);

        $this->connection->prepare($query)->execute([$_SESSION['user']['id'], $idArticle]);

        return (bool)$this->connection->rowCount();
    }

    public function addItem(array $data): int
    {
        $query = 'insert into articles(title, content, is_active, is_blocked, image_path, created_at, updated_at) values (?, ?, ?, ?, ?, ?, ?)';

        $this->connection->prepare($query)->execute(\array_values($data));

        return $this->connection->lastInsertId();
    }

}
