<?php
declare(strict_types=1);

namespace app\core;

use app\Database\DatabaseConfiguration;
use app\Database\DatabasePDOConnection;
use app\Database\PDODriver;

abstract class Model
{
    protected const TABLE_NAME = '';

    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';

    public function loadData(array $data): void
    {
        foreach ($data as $key => $value) {
            if (\property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

}
