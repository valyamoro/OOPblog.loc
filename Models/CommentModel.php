<?php

namespace app\Models;

use app\core\Model;

class CommentModel extends Model
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
            'content' => [$this->validator::RULE_REQUIRED, [$this->validator::RULE_MIN, 'min' => 4], [$this->validator::RULE_MAX, 'max' => 1024]],
        ];
    }

}
