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
                $messages['validate'] = $model->validator->errors;
            } else {
                if ($this->repository->getByEmail($data['email'])) {
                    $messages['warning'] = 'This email already exists!' . "\n";
                } else {
                    $now = \date('Y-m-d H:i:s');

                    $phoneNumber = \str_replace(['+', '8'], '', $data['phoneNumber']);
                    if (\strlen($phoneNumber) === 10 && !\str_starts_with($phoneNumber, '7')) {
                        $phoneNumber = '7' . $phoneNumber;
                    }

                    $data = [
                        'firstName' => $data['firstName'],
                        'lastName' => $data['lastName'],
                        'patronymic' => $data['patronymic'],
                        'email' => $data['email'],
                        'phone' => (int)$phoneNumber,
                        'password' => \password_hash($data['password'], PASSWORD_DEFAULT),
                        'is_bann' => 0,
                        'role' => 0,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];

                    if ($this->repository->add($data)) {
                        $_SESSION['success'] = 'You have successfully registered!' . "\n";
                        \header('Location: /');
                    } else {
                        $messages['warning'] =  'You are not registered! Please try again.' . "\n";
                    }
                }
            }
        }

        return $messages;
    }

}
