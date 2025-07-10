<?php

namespace App\Http\Controllers;

use App\Http\Resources\VehicleColorResource;
use App\Models\VehicleColor;
use Illuminate\Http\Request;

class VehicleColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = VehicleColor::paginate();

        return VehicleColorResource::collection($list);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $vehicleColor = VehicleColor::create($request->all());

        return new VehicleColorResource($vehicleColor);
    }

    /**
     * Display the specified resource.
     */
    public function show(VehicleColor $vehicleColor)
    {
        return new VehicleColorResource($vehicleColor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VehicleColor $vehicleColor)
    {
        $vehicleColor->update($request->all());

        return new VehicleColorResource($vehicleColor);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VehicleColor $vehicleColor)
    {
        $vehicleColor->delete();

        return response()->noContent();
    }

    public function restore(string $id)
    {
        $vehicleColor = VehicleColor::onlyTrashed()->findOrFail($id);

        return new VehicleColorResource($vehicleColor);
    }
}
