<?php

namespace App\Http\Controllers\Vehicle;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Vehicle\Models\VehicleActivity;

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
