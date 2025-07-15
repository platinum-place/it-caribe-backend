<?php

namespace App\Imports;

use App\Models\Vehicles\VehicleMake;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VehicleMakesImport implements ToModel, WithHeadingRow
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return VehicleMake::updateOrCreate(
            [
                'id' => $row['marcavehiculo_id'],
            ],
            [
                'name' => $row['description'],
                'code' => $row['codigosgs'],
            ]
        );
    }
}
