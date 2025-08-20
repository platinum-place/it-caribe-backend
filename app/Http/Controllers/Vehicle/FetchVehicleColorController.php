<?php

namespace App\Http\Controllers\Vehicle;

use App\Http\Controllers\Controller;
use App\Models\Vehicle\VehicleColor;
use Illuminate\Http\Request;

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
