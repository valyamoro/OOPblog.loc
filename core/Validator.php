<?php
declare(strict_types=1);

namespace app\core;

class Validator
{
    public const RULE_REQUIRED = 'required';
    public const RULE_PASSWORD = 'password';
    public const RULE_EMAIL = 'email';
    public const RULE_PHONE = 'phoneNumber';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';
    public const RULE_LETTERS = 'letter';
    public const RULE_IMAGE_EXTENSION = 'image_extension';
    public const RULE_IMAGE_SIZE = 'image_size';

    private array $rules;
    public array $errors = [];

    public function setRules($value): void
    {
        $this->rules = $value;
    }

    public function validate(Model $model): bool
    {
        foreach ($this->rules as $attribute => $rules) {
            $getAttribute = 'get' . $attribute;
            $value = $model->$getAttribute();
            foreach ($rules as $rule) {
                $ruleName = $rule;
                if (!\is_string($ruleName)) {
                    $ruleName = $rule[0];
                }

                if ($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addError($attribute, self::RULE_REQUIRED);
                }

                if ($ruleName === self::RULE_EMAIL && !\preg_match("/[0-9a-z]+@[a-z]/ui", $value)) {
                    $this->addError($attribute, self::RULE_EMAIL);
                }

                if ($ruleName === self::RULE_PHONE && !preg_match('/((8|\+7)-?)?\(?\d{3,5}\)?-?\d{1}-?\d{1}-?\d{1}-?\d{1}-?\d{1}((-?\d{1})?-?\d{1})?/',
                        $value)) {
                    $this->addError($attribute, self::RULE_PHONE);
                }

                if ($ruleName === self::RULE_MIN && \strlen($value) < $rule['min']) {
                    $this->addError($attribute, self::RULE_MIN, $rule);
                }

                if ($ruleName === self::RULE_MAX && \strlen($value) > $rule['max']) {
                    $this->addError($attribute, self::RULE_MAX, $rule);
                }

                if ($ruleName === self::RULE_MATCH && $value !== $model->getPassword()) {
                    $this->addError($attribute, self::RULE_MATCH, $rule);
                }

                if ($ruleName === self::RULE_LETTERS && !\preg_match('/^[a-zа-яё]+$/ui', $value)) {
                    $this->addError($attribute, self::RULE_LETTERS, $rule);
                }

                if ($ruleName === self::RULE_IMAGE_EXTENSION && !empty($value['name']) && !\in_array(\pathinfo($value['name'],
                        PATHINFO_EXTENSION), ['jpeg', 'png', 'webp', 'jpg'])) {
                    $this->addError($attribute, self::RULE_IMAGE_EXTENSION, $rule);
                }

                if ($ruleName === self::RULE_IMAGE_SIZE && $value['size'] > $rule['max']) {
                    $this->addError($attribute, self::RULE_IMAGE_SIZE, $rule);
                }

                if ($ruleName === self::RULE_PASSWORD) {
                    $message = '';

                    if (!\preg_match('/^(?![0-9]+$).+/', $value)) {
                        $message = 'Password cant have only numbers' . "\n";
                    } elseif (!\preg_match('/^[^!№;]+$/u', $value)) {
                        $message = 'Password have incorrect chars' . "\n";
                    } elseif (!\preg_match('/^(?![A-Za-z]+$).+/', $value)) {
                        $message = 'Password cant contain only letters!' . "\n";
                    } elseif (!\preg_match('/[A-Z]/', $value)) {
                        $message = 'Password must have one upper case letter' . "\n";
                    }

                    if (!empty($message)) {
                        $this->addError($attribute, self::RULE_PASSWORD, $rule, $message);
                    }
                }

            }

        }
        return empty($this->errors);
    }

    private function addError(string $attribute, string $rule, $params = [], string $message = ''): void
    {
        if (empty($message)) {
            $message = $this->errorMessages()[$rule] ?? '';
            foreach ($params as $key => $value) {
                $message = \str_replace("{{$key}}", (string)$value, $message);
            }
        }

        $this->errors[$attribute][] = $message;
    }

    private
    function errorMessages(): array
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'This field must be valid email address',
            self::RULE_PHONE => 'This field must be valid phone number',
            self::RULE_MIN => 'Min length of this field must be {min}',
            self::RULE_MAX => 'Max length of this field must be {max}',
            self::RULE_MATCH => 'This field must be the same as {match}',
            self::RULE_LETTERS => 'There should only be letters here',
            self::RULE_IMAGE_EXTENSION => 'This extension is not support',
            self::RULE_IMAGE_SIZE => 'This is too big image',
        ];

    }


}