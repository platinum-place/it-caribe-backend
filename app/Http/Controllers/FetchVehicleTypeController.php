<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Infrastructure\Catalogs\Vehicles\Persistence\Models\VehicleType;

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
