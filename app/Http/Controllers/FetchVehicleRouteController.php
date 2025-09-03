<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Infrastructure\Catalogs\Vehicles\Persistence\Models\VehicleRoute;

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
