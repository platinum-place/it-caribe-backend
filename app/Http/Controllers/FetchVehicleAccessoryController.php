<?php

namespace App\Http\Controllers;

use App\Models\VehicleAccessory;
use Illuminate\Http\Request;

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
