<?php

namespace App\Http\Controllers;

use App\Models\VehicleModel;
use Illuminate\Http\Request;

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
