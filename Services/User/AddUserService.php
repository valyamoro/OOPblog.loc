<?php
declare(strict_types=1);

namespace app\Services\User;

use app\Models\UserModel;
use app\Services\BaseService;

class AddUserService extends BaseService
{
    public function add(): array
    {
        $result = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $post = $this->request->getPost();
            $model = new UserModel(...$post);
            $model->validator->setRules($model->rules());

            if (!$model->validator->validate($model)) {
                $result['validate'] = $model->validator->errors;
            } else {
                if ($this->repository->getByEmail($post['email'])) {
                    $result['warning'] = 'This email already exists!' . "\n";
                } else {
                    $post['phoneNumber'] = $this->formatPhoneNumber($post['phoneNumber']);

                    if (!empty($_SESSION['user']) && $_SESSION['user']['role'] !== '1') {
                        $post['role'] = 0;
                    }

                    $post['currentDate'] = \date('Y-m-d H:i:s');

                    if ($this->repository->add($this->formatUserData($post))) {
                        $_SESSION['success'] = 'You have successfully registered!' . "\n";
                        \header('Location: /');
                    } else {
                        $result['warning'] = 'You are not registered! Please try again.' . "\n";
                    }
                }
            }

        }

        return $result;
    }

    private function formatUserData(array $data): array
    {
        return [
            $data['firstName'],
            $data['lastName'],
            $data['patronymic'],
            $data['email'],
            (int)$data['phoneNumber'],
            \password_hash($data['password'], PASSWORD_DEFAULT),
            0,
            $data['role'],
            $data['currentDate'],
            $data['currentDate'],
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
