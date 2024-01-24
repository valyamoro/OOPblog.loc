<?php
declare(strict_types=1);

namespace app\Services\Users;

use app\Models\UserModel;
use app\Services\BaseService;

class AuthUserService extends BaseService
{
    public function auth(array $data)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $this->repository->getByEmail($data['email']);

            if (empty($result)) {
                $_SESSION['warning'] = 'This email doesnt exist!' . "\n";
            } else {
                if (!\password_verify($data['password'], $result['password'])) {
                    $_SESSION['warning'] = 'Incorrect password!';
                } else {
                    $_SESSION['user'] = [
                        'id' => $result['id'],
                        'firstName' => $result['firstName'],
                        'lastName' => $result['lastName'],
                        'patronymic' => $result['patronymic'],
                        'email' => $result['email'],
                        'phone' => $result['phone'],
                        'password' => $result['password'],
                        'created_at' => $result['created_at'],
                        'updated_at' => $result['updated_at'],
                    ];

                    $_SESSION['success'] = 'You have successfully logged in!' . "\n";
                    \header('Location: /home');
                }
            }
        }
    }

}
