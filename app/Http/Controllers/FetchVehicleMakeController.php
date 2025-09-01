<?php

namespace App\Http\Controllers;

use App\Models\VehicleMake;
use Illuminate\Http\Request;

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
