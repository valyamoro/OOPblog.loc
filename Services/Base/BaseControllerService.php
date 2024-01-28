<?php
declare(strict_types=1);

namespace app\Services\Base;

use app\Services\BaseService;

class BaseControllerService extends BaseService
{
    public function getAllCategories(): array
    {
        $categories = $this->repository->getAll();

        $formattedCategories = [];
        foreach ($categories as $value) {
            $formattedCategories[$value['id']] = $value;
        }

        return $this->mapTree($formattedCategories);
    }

    public function mapTree(array $dataSet): array
    {
        $tree = [];

        foreach ($dataSet as $id => &$node) {
            if (!$node['id_parent']) {
                $tree[$id] = &$node;
            } else {
                $dataSet[$node['id_parent']]['childs'][$id] = &$node;
            }
        }

        return $tree;
    }

}
