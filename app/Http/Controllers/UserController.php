<?php

namespace App\Http\Controllers;

use App\Contracts\Services\UserServiceContract;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(protected UserServiceContract $contract) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $list = $this->contract->search($request->all());

        return UserResource::collection($list);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $record = $this->contract->store($request->all());

        return new UserResource($record);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $record = $this->contract->getById($id);

        return new UserResource($record);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $record = $this->contract->update($id, $request->all());

        return new UserResource($record);
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

        return new UserResource($record);
    }
}
