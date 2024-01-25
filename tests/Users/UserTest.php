<?php

namespace app\tests\Users;

use app\Controllers\UserController;
use app\core\Http\Request;
use app\Database\DatabaseConfiguration;
use app\Database\DatabasePDOConnection;
use app\Database\PDODriver;
use app\Models\UserModel;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private UserModel $user;
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
        ];

        $this->user = new UserModel(...$data);
    }

    public function testValidate(): void
    {
        $this->user->validator->setRules($this->user->rules());
        $this->user->validator->validate($this->user);

        $this->assertSame($this->user->validator->errors, []);
    }

}
