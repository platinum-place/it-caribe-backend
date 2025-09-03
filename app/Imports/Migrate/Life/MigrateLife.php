<?php

namespace App\Imports\Migrate\Life;

use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MigrateLife implements WithCalculatedFormulas, WithHeadingRow, WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            2 => new Sheet3,
        ];
    }
}
