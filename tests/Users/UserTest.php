<?php

namespace app\tests\Users;

use app\core\Http\Request;
use app\Database\DatabaseConfiguration;
use app\Database\DatabasePDOConnection;
use app\Database\PDODriver;
use app\Models\UserModel;
use app\Services\Comments\AddCommentService;
use app\Services\Comments\Repositories\AddCommentRepository;
use app\Services\Users\AddUserService;
use app\Services\Users\AuthUserService;
use app\Services\Users\ProfileUserService;
use app\Services\Users\Repositories\AddUserRepository;
use app\Services\Users\Repositories\AuthUserRepository;
use app\Services\Users\Repositories\ProfileUserRepository;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private UserModel $user;
    private PDODriver $connection;
    private array $data;

    public function setUp(): void
    {
        $data = [
            'kutlumbek',
            'kutlumbekov',
            'kutlumbekovich',
            'kutlumbek@gmail.com',
            '793332312332',
            'heeewqqwD123rfd',
            'heeewqqwD123rfd',
            1
        ];

        $this->data = $data;
        $this->user = new UserModel(...$data);
        $this->connection = $this->dbConnection();
        $this->request = new Request();
    }

    public function dbConnection(): PDODriver
    {
        $configuration = require __DIR__ . '/../../config/test_db.php';
        $dataBaseConfiguration = new DatabaseConfiguration(...$configuration);
        $dataBasePDOConnection = new DatabasePDOConnection($dataBaseConfiguration);

        return new PDODriver($dataBasePDOConnection->connection());
    }

    public function testValidate(): void
    {
        $this->user->validator->setRules($this->user->rules());
        $this->user->validator->validate($this->user);

        $this->assertSame($this->user->validator->errors, []);
    }

    public function testAdd(): void
    {
        $repository = new AddUserRepository($this->connection);
        $service = new AddUserService($repository);

        $result = $service->add($this->data);

        $this->assertSame($result, []);
    }

    public function testAuth(): void
    {
        $data = [$this->data['email'], $this->data['password']];
        $repository = new AuthUserRepository($this->connection);
        $service = new AuthUserService($repository);

        $result = $service->auth($data);

        $this->assertSame($result, []);
    }

}
