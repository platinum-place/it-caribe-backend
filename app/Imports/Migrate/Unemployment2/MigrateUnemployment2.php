<?php

namespace App\Imports\Migrate\Unemployment2;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MigrateUnemployment2 implements WithHeadingRow, WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            0 => new Sheet1,
            1 => new Sheet2,
        ];
    }
}
