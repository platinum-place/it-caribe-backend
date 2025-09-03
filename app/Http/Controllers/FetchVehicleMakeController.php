<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Infrastructure\Catalogs\Vehicles\Persistence\Models\VehicleMake;

class FetchVehicleMakeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $brands = VehicleMake::all()->map(function ($brand) {
            return [
                'IdMarca' => $brand->id,
                'Marca' => $brand->name,
            ];
        });

        return response()->json($brands);
    }
}
