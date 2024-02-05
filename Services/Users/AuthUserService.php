<?php
declare(strict_types=1);

namespace app\Services\Users;

use app\Models\UserModel;
use app\Services\BaseService;

class AuthUserService extends BaseService
{
    public function auth(array $post): array
    {
        $result = [];

        if (!empty($_SESSION['user'])) {
            $_SESSION['message'] = 'You are already authorized!' . "\n";
            \header('Location: /');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $this->repository->getByEmail($post['email']);

            if (empty($result)) {
                $result['validate']['email'] = 'This email doesnt exist!' . "\n";
            } else {
                if (!\password_verify($post['password'], $result['password'])) {
                    $result['validate']['password'] = 'Incorrect password!' . "\n";
                } else {
                    $userData = $this->formatUserData($result);
                    $_SESSION['user'] = $userData;

                    $_SESSION['success'] = 'You have successfully logged in!' . "\n";
                    \header('Location: /');
                }
            }
        }

        return $result;
    }

    private function formatUserData(array $data): array
    {
        return [
            'id' => $data['id'],
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'patronymic' => $data['patronymic'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => $data['password'],
            'is_bann' => $data['is_bann'],
            'role' => $data['role'],
            'created_at' => $data['created_at'],
            'updated_at' => $data['updated_at'],
        ];
    }

}
