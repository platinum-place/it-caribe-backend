<?php

namespace App\Http\Controllers;

use App\Models\VehicleRoute;
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
