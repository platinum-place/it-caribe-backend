<?php

namespace App\Imports\Vehicle;

use App\Models\Vehicle\VehicleModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VehicleModelsImport implements ToModel, WithHeadingRow
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return VehicleModel::updateOrCreate(
            [
                'id' => $row['modelovehiculo_id'],
            ],
            [
                'id' => $row['modelovehiculo_id'],
                'name' => $row['description'],
                'code' => $row['codigosgs'],
                'vehicle_make_id' => $row['marcavehiculo_id'],
                // 'vehicle_type_id' => /**  $row['modelovehiculo_id']*/ 1,
            ]
        );
    }
}
