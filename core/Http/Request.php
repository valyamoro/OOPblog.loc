<?php

namespace app\core\Http;

class Request
{
    private function getUri(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function parseUri(): array
    {
        return \parse_url($this->getUri());
    }

    public function getCategory(): ?string
    {
        $data = $this->parseUri();
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

    public function createSegmentsOfUri(Request $request): array
    {
        $parts = $request->parseUri();
        return $parts['path'] === '/'
            ? ['Home']
            : \explode('/', \trim($parts['path'], '/'));
    }

}
