<?php

namespace App\Http\Controllers;

use App\Contracts\Services\VehicleTypeServiceContract;
use App\Http\Resources\VehicleTypeResource;
use Illuminate\Http\Request;

class VehicleTypeController extends Controller
{
    public function __construct(protected VehicleTypeServiceContract $contract) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $list = $this->contract->search($request->all());

        return VehicleTypeResource::collection($list);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $record = $this->contract->store($request->all());

        return new VehicleTypeResource($record);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $record = $this->contract->getById($id);

        return new VehicleTypeResource($record);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $record = $this->contract->update($id, $request->all());

        return new VehicleTypeResource($record);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->contract->destroy($id);

        return response()->noContent();
    }

    public function restore(string $id)
    {
        $record = $this->contract->restore($id);

        return new VehicleTypeResource($record);
    }
}
