<?php

namespace app\core\Http;

class Request
{
    public function getPost(): array
    {
        $result = [];

        foreach ($_POST as $key => $value) {
            $result[$key] = \htmlspecialchars(strip_tags(trim($value)));
        }

        return $result;
    }

}
