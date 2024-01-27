<?php
declare(strict_types=1);

namespace app\Services\Articles\Repositories;

use app\Services\BaseRepository;

class CategoryArticleRepository extends BaseRepository
{
    public function getIdByTitle(string $category): int
    {
        $query = 'select id from categories where title=?';

        $this->connection->prepare($query)->execute([$category]);

        return (int)$this->connection->fetch()['id'];
    }

    public function getArticlesByCategory(int $id): array
    {
        $query = 'select * from articles 
        join articles_categories   
        on articles.id = articles_categories.id_article 
         where articles_categories.id_category=?';

        $this->connection->prepare($query)->execute([$id]);

        return $this->connection->fetchAll();
    }

}
