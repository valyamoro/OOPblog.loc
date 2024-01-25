<?php
declare(strict_types=1);

namespace app\Services\Users;

use app\Models\UserModel;
use app\Services\BaseService;

class AddUserService extends BaseService
{
    public function add(array $data): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Переименовать. result плохое название.
            $result = new UserModel(...$data);
            $result->validator->setRules($result->rules());

            // Сначала false
            if ($result->validator->validate($result)) {
                $now = \date('Y-m-d H:i:s');

                $phoneNumber = \str_replace(['+', '8'], '', $data['phoneNumber']);
                if (strlen($phoneNumber) === 10 && !str_starts_with($phoneNumber, '7')) {
                    $phoneNumber = '7' . $phoneNumber;
                }

                $data = [
                    'firstName' => $data['firstName'], // 48
                    'lastName' => $data['lastName'], // 48
                    'patronymic' => $data['patronymic'], // 48
                    'email' => $data['email'], // 64
                    'phone' => (int)$phoneNumber, // 11
                    'password' => \password_hash($data['password'], PASSWORD_DEFAULT),
                    'is_bann' => 0,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];

                if ($this->repository->add($data)) {
                    $_SESSION['success'] = 'Вы успешно зарегистрировались!';
                    \header('Location: /home');
                } else {
                    // Возвращать result и передавать в вид ошибки.
                    $_SESSION['warning'] = 'Вы не зарегистрировались! Пожалуйста, попробуйте снова.';
                }
            } else {
                $_SESSION['validate'] = $result->validator->errors;
            }

        }
    }

}