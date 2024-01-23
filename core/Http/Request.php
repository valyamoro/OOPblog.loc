<?php

namespace app\core\Http;

class Request
{
    public function getPost(): array
    {
        return $_POST;
    }

}
