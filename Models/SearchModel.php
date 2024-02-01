<?php

namespace app\Models;

use app\core\Model;

class SearchModel extends Model
{
    public function __construct(
        private readonly string $content,
    ) {
        parent::__construct();
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function rules(): array
    {
        return [
            'content' => [$this->validator::RULE_REQUIRED, [$this->validator::RULE_LETTERS], [$this->validator::RULE_MIN, 'min' => 1], [$this->validator::RULE_MAX, 'max' => 48]],
        ];
    }

}
