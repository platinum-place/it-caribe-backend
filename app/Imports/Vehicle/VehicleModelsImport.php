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
        $attributes = [
            'id' => $row['modelovehiculo_id'],
        ];

        $values = [
            'id' => $row['modelovehiculo_id'],
            'name' => $row['description'],
            'code' => $row['codigosgs'],
            'vehicle_make_id' => $row['marcavehiculo_id'],
        ];

        $exists = VehicleModel::where('id', $row['modelovehiculo_id'])->exists();

        if (! $exists) {
            $values['vehicle_type_id'] = 1;
        }

        return VehicleModel::updateOrCreate($attributes, $values);
    }
}
