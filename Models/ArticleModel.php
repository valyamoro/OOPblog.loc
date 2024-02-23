<?php

namespace app\Models;

use app\core\Model;

class ArticleModel extends Model
{
    public function __construct(
        private readonly string $title,
        private readonly string $content,
        private readonly array $image,
    ) {
        parent::__construct();
    }

    public function getImage(): array
    {
        return $this->image;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function rules(): array
    {
        return [
            'title' => [$this->validator::RULE_REQUIRED, [$this->validator::RULE_MIN, 'min' => 4], [$this->validator::RULE_MAX, 'max' => 128]],
            'content' => [$this->validator::RULE_REQUIRED, [$this->validator::RULE_MIN, 'min' => 64], [$this->validator::RULE_MAX, 'max' => 12000]],
            'image' => [[$this->validator::RULE_IMAGE_EXTENSION], [$this->validator::RULE_IMAGE_SIZE, 'max' => (1824 * 1024)]],
        ];
    }

}
