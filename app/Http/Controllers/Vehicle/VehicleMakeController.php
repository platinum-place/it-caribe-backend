<?php

namespace App\Http\Controllers\Vehicle;

use App\Contracts\Services\Vehicle\VehicleMakeServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Resources\Vehicle\VehicleMakeResource;
use Illuminate\Http\Request;

class VehicleMakeController extends Controller
{
    public function __construct(protected VehicleMakeServiceContract $contract) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $list = $this->contract->search($request->all());

        return VehicleMakeResource::collection($list);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $record = $this->contract->store($request->all());

        return new VehicleMakeResource($record);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $record = $this->contract->getById($id);

        return new VehicleMakeResource($record);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $record = $this->contract->update($id, $request->all());

        return new VehicleMakeResource($record);
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

        return new VehicleMakeResource($record);
    }

    public function import(Request $request)
    {
        $this->contract->import($request->file('file'));

        return response()->noContent();
    }
}
