<?php
declare(strict_types=1);

namespace app\core\Factory;

use app\Services\BaseRepository;

class RepositoryFactory
{
    public static function createRepository(string $repositoryName, string $action = ''): BaseRepository
    {
        return new ("app\Services\\{$repositoryName}\Repositories\\{$action}{$repositoryName}Repository")();
    }

}
