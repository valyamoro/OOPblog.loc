<?php

namespace app\core\Http;

class Request
{
    private function getUri(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function parseUri(): string
    {
        return \parse_url($this->getUri(), PHP_URL_PATH);
    }

    public function getCategory(): ?string
    {
        $path = $this->parseUri();
        $parts = \explode('/', $path);

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

    public function createSegmentsOfUri(Request $request): array
    {
        $path = $request->parseUri();
        return $path === '/'
            ? ['Home']
            : \explode('/', \trim($path, '/'));
    }

}
