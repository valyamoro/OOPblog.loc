<?php

namespace app\Models;

use app\core\Model;

class UserModel extends Model
{
    public function __construct(
        private readonly string $firstName,
        private readonly string $lastName,
        private readonly string $patronymic,
        private readonly string $email,
        private readonly string $phoneNumber,
        private readonly string $password,
        private readonly string $passwordConfirm,
        private readonly string $role,
    ) {
        parent::__construct();
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function getPatronymic(): string
    {
        return $this->patronymic;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getPasswordConfirm(): string
    {
        return $this->passwordConfirm;
    }

    public function rules(): array
    {
        return [
            'firstName' => [$this->validator::RULE_REQUIRED, [$this->validator::RULE_MIN, 'min' => 3], [$this->validator::RULE_MAX, 'max' => 48], [$this->validator::RULE_LETTERS]],
            'lastName' => [$this->validator::RULE_REQUIRED, [$this->validator::RULE_MIN, 'min' => 3], [$this->validator::RULE_MAX, 'max' => 48], [$this->validator::RULE_LETTERS]],
            'patronymic' => [$this->validator::RULE_REQUIRED, [$this->validator::RULE_MIN, 'min' => 3], [$this->validator::RULE_MAX, 'max' => 48], [$this->validator::RULE_LETTERS]],
            'email' => [$this->validator::RULE_REQUIRED, $this->validator::RULE_EMAIL, [$this->validator::RULE_MIN, 'min' => 3], [$this->validator::RULE_MAX, 'max' => 128]],
            'phoneNumber' => [$this->validator::RULE_REQUIRED, $this->validator::RULE_PHONE],
            'password' => [$this->validator::RULE_REQUIRED, [$this->validator::RULE_MIN, 'min' => 8], [$this->validator::RULE_MAX, 'max' => 128]],
            'passwordConfirm' => [$this->validator::RULE_REQUIRED, [$this->validator::RULE_MATCH, 'match' => 'password']],
        ];
    }

}
