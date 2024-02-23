<?php
declare(strict_types=1);

namespace app\core;

use app\Database\DatabaseConfiguration;
use app\Database\DatabasePDOConnection;
use app\Database\PDODriver;

abstract class Model
{
    public Validator $validator;

    public function __construct()
    {
        $this->validator = new Validator();
    }

}
