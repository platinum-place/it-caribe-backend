<?php

namespace App\Http\Controllers\Vehicle;

use App\Http\Controllers\Controller;
use App\Models\Vehicle\VehicleRoute;
use Illuminate\Http\Request;

class FetchVehicleRouteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $routes = VehicleRoute::all()->map(function ($route) {
            return [
                'IdCirculacion' => $route->id,
                'circulacion' => $route->name,
            ];
        });

        return response()->json($routes);
    }
}
