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

    private function mapTree(array $data): array
    {
        $tree = [];

        foreach ($data as $key => &$value) {
            if (!$value['id_parent']) {
                $tree[$key] = &$value;
            } else {
                $data[$value['id_parent']]['child'][$key] = &$value;
            }
        }

        return $tree;
    }

}
