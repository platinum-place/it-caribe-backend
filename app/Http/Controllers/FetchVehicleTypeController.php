<?php

namespace App\Http\Controllers;

use App\Models\VehicleType;
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
