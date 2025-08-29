<?php

namespace App\Http\Controllers\Vehicle;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Vehicle\Models\VehicleAccessory;

class FetchVehicleAccessoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $accessories = VehicleAccessory::all()->map(function ($accessory) {
            return [
                'IdAccesorio' => $accessory->id,
                'Accesorio' => $accessory->name,
            ];
        });

        return response()->json($accessories);
    }
}
