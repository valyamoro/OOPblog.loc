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

    public function getCategoriesIds(array $data, int $id): string
    {
        $string = "{$id},";

        foreach ($data as $item) {
            if ((int)$item['id_parent'] === $id) {
                $string .= $item['id'] . ',';
                $string .= $this->getCategoriesIds($data, $item['id']);
            }
        }

        return $string;
    }

    public function getAllCategories(): array
    {
        $query = 'select * from categories';

        $this->connection->prepare($query)->execute();

        return $this->connection->fetchAll();
    }

    public function getArticles(string $ids): array
    {
        $query = "SELECT * FROM articles
          JOIN articles_categories ON articles.id = articles_categories.id_article 
          WHERE articles_categories.id_category IN ({$ids})";

        $this->connection->prepare($query)->execute();

        return $this->connection->fetchAll();
    }

}
