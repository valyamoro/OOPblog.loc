<?php
declare(strict_types=1);

namespace app\Services\Users;

use app\Models\UserModel;
use app\Services\BaseService;

class AuthUserService extends BaseService
{
    public function auth(array $data): array
    {
        $messages = [];

        if (!empty($_SESSION['user'])) {
            $_SESSION['message'] = 'You are already authorized!' . "\n";
            \header('Location: /');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $this->repository->getByEmail($data['email']);

            if (empty($result)) {
                $messages['email'] = 'This email doesnt exist!' . "\n";
            } else {
                if (!\password_verify($data['password'], $result['password'])) {
                    $messages['password'] = 'Incorrect password!' . "\n";
                } else {
                    $_SESSION['user'] = [
                        'id' => $result['id'],
                        'firstName' => $result['firstName'],
                        'lastName' => $result['lastName'],
                        'patronymic' => $result['patronymic'],
                        'email' => $result['email'],
                        'phone' => $result['phone'],
                        'password' => $result['password'],
                        'is_bann' => $result['is_bann'],
                        'role' => $result['role'],
                        'created_at' => $result['created_at'],
                        'updated_at' => $result['updated_at'],
                    ];

                    $_SESSION['success'] = 'You have successfully logged in!' . "\n";
                    \header('Location: /');
                }
            }
        }

        return $messages;
    }

}
