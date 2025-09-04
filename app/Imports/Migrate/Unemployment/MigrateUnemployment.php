<?php

namespace App\Imports\Migrate\Unemployment;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MigrateUnemployment implements WithHeadingRow, WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            0 => new Sheet1,
        ];
    }
}
