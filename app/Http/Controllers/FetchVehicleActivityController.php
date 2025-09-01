<?php

namespace App\Http\Controllers;

use App\Models\VehicleActivity;
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
