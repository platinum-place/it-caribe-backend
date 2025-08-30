<?php

namespace App\Http\Controllers\Vehicle;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use old\Modules\Vehicle\app\Models\VehicleRoute;

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
