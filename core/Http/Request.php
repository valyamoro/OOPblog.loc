<?php

namespace app\core\Http;

class Request
{
    public function getUri(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function parseUrl(): array
    {
        return \parse_url($this->getUri());
    }

    public function getCategory(): ?string
    {
        $data = $this->parseUrl();
        $parts = \explode('/', $data['path']);

        return $parts[3] ?? null;
    }

    public function getPost(): array
    {
        return $_POST;
    }

    public function getGET(): array
    {
        return $_GET;
    }

    public function getFiles(): array
    {
        return $_FILES;
    }

}
