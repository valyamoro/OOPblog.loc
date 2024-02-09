<?php
declare(strict_types=1);

namespace app\Services\Article\Repositories;

use app\Services\BaseRepository;

class CategoryArticleRepository extends BaseRepository
{
    public function getIdByCategory(string $category): int
    {
        $query = 'select id from categories where title=?';

        $this->connection->prepare($query)->execute([$category]);

        $result = $this->connection->fetch();
        return (int)(empty($result) ? 0 : $result['id']);
    }

    public function getCategoriesIds(array $data, int $id): string
    {
        $string = '';

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

    public function getArticles(int $limit, int $offset, string $order, string $item, string $condition, array $ids): array
    {
        $ids = \explode(',', $ids[0]);
        $placeholders = \rtrim(\str_repeat('?,', \count($ids)), ',');

        $query = "SELECT * FROM articles
          JOIN articles_categories ON articles.id = articles_categories.id_article
          WHERE articles_categories.id_category IN ({$placeholders}) order by created_at {$order} limit {$limit} offset {$offset}";

        $this->connection->prepare($query)->execute([...$ids]);

        return $this->connection->fetchAll();
    }

    public function getCountArticlesByIdCategory(string $ids): int
    {
        $ids = \explode(',', $ids);
        $placeholders = \rtrim(\str_repeat('?,', \count($ids)), ',');

        $query = "SELECT count(articles.id) FROM articles
          JOIN articles_categories ON articles.id = articles_categories.id_article
          WHERE articles_categories.id_category IN ({$placeholders})";

        $this->connection->prepare($query)->execute([...$ids]);

        return \array_values($this->connection->fetch())[0];
    }

}
