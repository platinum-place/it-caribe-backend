<?php

namespace App\Http\Controllers\Vehicle;

use App\Http\Controllers\Controller;
use App\Models\Vehicle\VehicleType;
use Illuminate\Http\Request;

class FetchVehicleTypeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $types = VehicleType::all()->map(function ($type) {
            return [
                'IdTipoVehiculo' => $type->id,
                'TipoVehiculo' => $type->name,
            ];
        });

        return response()->json($types);
    }
}
