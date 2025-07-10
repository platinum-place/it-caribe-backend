<?php

namespace App\Http\Controllers;

use App\Http\Resources\VehicleUseResource;
use App\Models\VehicleUse;
use Illuminate\Http\Request;

class VehicleUseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = VehicleUse::paginate();

        return VehicleUseResource::collection($list);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $vehicleUse = VehicleUse::create($request->all());

        return new VehicleUseResource($vehicleUse);
    }

    /**
     * Display the specified resource.
     */
    public function show(VehicleUse $vehicleUse)
    {
        return new VehicleUseResource($vehicleUse);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VehicleUse $vehicleUse)
    {
        $vehicleUse->update($request->all());

        return new VehicleUseResource($vehicleUse);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VehicleUse $vehicleUse)
    {
        $vehicleUse->delete();

        return response()->noContent();
    }

    public function restore(string $id)
    {
        $vehicleUse = VehicleUse::onlyTrashed()->findOrFail($id);

        return new VehicleUseResource($vehicleUse);
    }
}
