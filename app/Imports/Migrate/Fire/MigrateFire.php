<?php

namespace App\Imports\Migrate\Fire;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MigrateFire implements WithHeadingRow, WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            0 => new Sheet1,
            1 => new Sheet2,
            2 => new Sheet3,
            3 => new Sheet4,
        ];
    }
}
