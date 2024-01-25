<?php
declare(strict_types=1);

namespace app\Services\Users;

use app\Models\UserModel;
use app\Services\BaseService;

class AddUserService extends BaseService
{
    public function add(array $data): array
    {
        $messages = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new UserModel(...$data);
            $model->validator->setRules($model->rules());

            if (!$model->validator->validate($model)) {
                $messages = $model->validator->errors;
            } else {
                $now = \date('Y-m-d H:i:s');

                $phoneNumber = \str_replace(['+', '8'], '', $data['phoneNumber']);
                if (\strlen($phoneNumber) === 10 && !\str_starts_with($phoneNumber, '7')) {
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
                    $_SESSION['warning'] = 'Вы не зарегистрировались! Пожалуйста, попробуйте снова.';
                }
            }
        }

        return $messages;
    }

}
