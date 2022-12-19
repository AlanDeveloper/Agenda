<?php

namespace App\Traits;

use App\Models\Logs;

trait LogsTrait
{
    public static function createLog($tableName, $description, $method, $status)
    {
        if (gettype($description) == "array") {
            $description = implode("|", $description);
        }

        Logs::create(
            array(
                'table' => $tableName,
                'method' => $method,
                'status' => $status,
                'description' => $description,
            )
        );
    }
}
