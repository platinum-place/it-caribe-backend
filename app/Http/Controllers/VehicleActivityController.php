<?php

namespace App\Http\Controllers;

use App\Http\Resources\VehicleActivityResource;
use App\Models\VehicleActivity;
use Illuminate\Http\Request;

class VehicleActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = VehicleActivity::paginate();

        return VehicleActivityResource::collection($list);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $vehicleActivity = VehicleActivity::create($request->all());

        return new VehicleActivityResource($vehicleActivity);
    }

    /**
     * Display the specified resource.
     */
    public function show(VehicleActivity $vehicleActivity)
    {
        return new VehicleActivityResource($vehicleActivity);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VehicleActivity $vehicleActivity)
    {
        $vehicleActivity->update($request->all());

        return new VehicleActivityResource($vehicleActivity);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VehicleActivity $vehicleActivity)
    {
        $vehicleActivity->delete();

        return response()->noContent();
    }

    public function restore(string $id)
    {
        $vehicleActivity = VehicleActivity::onlyTrashed()->findOrFail($id);

        return new VehicleActivityResource($vehicleActivity);
    }
}
