<?php

namespace app\Services\User;

use app\Services\BaseService;

class LogoutUserService extends BaseService
{
    public function logout(): void
    {
        unset($_SESSION['user']);
        $_SESSION['message'] = 'You logout!' . "\n";
        \header('Location: /');
    }

}
