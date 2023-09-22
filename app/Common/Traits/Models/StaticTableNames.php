<?php

declare(strict_types=1);

namespace App\Common\Traits\Models;

trait StaticTableNames
{
    /**
     * Return table name for the model.
     *
     * @return string
     */
    public static function getTableName(): string
    {
        return (new static())->getTable();
    }
}
