<?php

namespace App\Http\Controllers;

use App\Http\Resources\VehicleAccessoryResource;
use App\Models\VehicleAccessory;
use Illuminate\Http\Request;

class VehicleAccessoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = VehicleAccessory::paginate();

        return VehicleAccessoryResource::collection($list);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $vehicleAccessory = VehicleAccessory::create($request->all());

        return new VehicleAccessoryResource($vehicleAccessory);
    }

    /**
     * Display the specified resource.
     */
    public function show(VehicleAccessory $vehicleAccessory)
    {
        return new VehicleAccessoryResource($vehicleAccessory);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VehicleAccessory $vehicleAccessory)
    {
        $vehicleAccessory->update($request->all());

        return new VehicleAccessoryResource($vehicleAccessory);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VehicleAccessory $vehicleAccessory)
    {
        $vehicleAccessory->delete();

        return response()->noContent();
    }

    public function restore(string $id)
    {
        $vehicleAccessory = VehicleAccessory::onlyTrashed()->findOrFail($id);

        return new VehicleAccessoryResource($vehicleAccessory);
    }
}
