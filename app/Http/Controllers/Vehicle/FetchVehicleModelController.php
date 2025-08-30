<?php

namespace App\Http\Controllers\Vehicle;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use old\Modules\Vehicle\app\Models\VehicleModel;

class FetchVehicleModelController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $makeId)
    {
        $models = VehicleModel::where('vehicle_make_id', $makeId)
            ->get()
            ->map(function ($model) {
                return [
                    'IdMarca' => $model->vehicle_make_id,
                    'IdModelo' => $model->id,
                    'Modelo' => $model->name,
                ];
            })
            ->sortBy(fn ($model) => reset($model));

        return response()->json($models);
    }
}
