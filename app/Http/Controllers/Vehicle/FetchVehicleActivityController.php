<?php

namespace App\Http\Controllers\Vehicle;

use App\Http\Controllers\Controller;
use App\Models\Vehicle\VehicleActivity;
use Illuminate\Http\Request;

class FetchVehicleActivityController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $activities = VehicleActivity::all()->map(function ($activity) {
            return [
                'IdActividad' => $activity->id,
                'Actividad' => $activity->name,
            ];
        });

        return response()->json($activities);
    }
}
