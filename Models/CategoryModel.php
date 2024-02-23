<?php

namespace app\Models;

use app\core\Model;

class CategoryModel extends Model
{
    public function __construct(private readonly string $title)
    {
        parent::__construct();
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function rules(): array
    {
        return [
            'title' => [$this->validator::RULE_REQUIRED, [$this->validator::RULE_MIN, 'min' => 3], [$this->validator::RULE_MAX, 'max' => 48], [$this->validator::RULE_LETTERS]],
        ];
    }
}