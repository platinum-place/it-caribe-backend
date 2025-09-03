<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Infrastructure\Catalogs\Vehicles\Persistence\Models\VehicleAccessory;

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
