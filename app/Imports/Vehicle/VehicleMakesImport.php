<?php

namespace App\Imports\Vehicle;

use App\Models\Vehicle\VehicleMake;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VehicleMakesImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
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
