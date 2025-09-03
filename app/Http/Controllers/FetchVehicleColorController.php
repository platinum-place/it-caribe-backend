<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Infrastructure\Catalogs\Vehicles\Persistence\Models\VehicleColor;

class FetchVehicleColorController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $colors = VehicleColor::all()->map(function ($color) {
            return [
                'IdColor' => $color->id,
                'Color' => $color->name,
            ];
        });

        return response()->json($colors);
    }
}
