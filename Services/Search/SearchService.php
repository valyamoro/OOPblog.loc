<?php

namespace app\Services\Search;

use app\Services\BaseService;

class SearchService extends BaseService
{
    public function search(string $value): array
    {
        if (empty($value)) {
            $_SESSION['message'] = 'You must enter something!' . "\n";
            \header('Location: /');
        }

        $result = $this->repository->search($value);
        if (empty($result)) {
            $_SESSION['message'] = 'There are no such articles!' . "\n";
            \header('Location: /');
        }

        return $result;
    }

}
