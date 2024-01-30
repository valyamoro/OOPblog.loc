<?php
declare(strict_types=1);

namespace app\Services\Users;

use app\Models\UserModel;
use app\Services\BaseService;

class AddUserService extends BaseService
{
    public function add(array $request): array
    {
        $result = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new UserModel(...$request);
            $model->validator->setRules($model->rules());

            if (!$model->validator->validate($model)) {
                $result['validate'] = $model->validator->errors;
            } else {
                if ($this->repository->getByEmail($request['email'])) {
                    $result['warning'] = 'This email already exists!' . "\n";
                } else {
                    $request['phoneNumber'] = $this->formatPhoneNumber($request['phoneNumber']);

                    if (!empty($_SESSION['user']) && $_SESSION['user']['role'] !== '1') {
                        $request['role'] = 0;
                    }

                    $request['currentDate'] = \date('Y-m-d H:i:s');

                    if ($this->repository->add($this->formatUserData($request))) {
                        $_SESSION['success'] = 'You have successfully registered!' . "\n";
                        \header('Location: /');
                    } else {
                        $result['warning'] =  'You are not registered! Please try again.' . "\n";
                    }
                }
            }
        }

        return $result;
    }

    private function formatUserData(array $data): array
    {
        return [
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'patronymic' => $data['patronymic'],
            'email' => $data['email'],
            'phone' => (int)$data['phoneNumber'],
            'password' => \password_hash($data['password'], PASSWORD_DEFAULT),
            'is_bann' => 0,
            'role' => $data['role'],
            'created_at' => $data['currentDate'],
            'updated_at' => $data['currentDate'],
        ];
    }

    private function formatPhoneNumber(string $value): string
    {
        $value = \str_replace(['+', '8'], '', $value);
        if (\strlen($value) === 10 && !\str_starts_with($value, '7')) {
            return ('7' . $value);
        }

        return $value;
    }

}
