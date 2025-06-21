<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Repositories\UserRepository;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function __construct(protected UserRepository $repository) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->repository->all();

        $users = $users->filter(function ($user) {
            return $user->id !== auth()->user()->id;
        });

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $this->repository->store($request->validated());

        return redirect()->route('users.index')->with('message', 'Usuario creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = $this->repository->getById($id);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $this->repository->update($id, $request->validated());

        return redirect()->route('users.index')->with('message', 'Usuario actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->repository->destroy($id);

        return redirect()->back()->with('message', 'Usuario eliminado con éxito.');
    }

    public function resetPassword(string $id)
    {
        $password = Str::random(8);

        $this->repository->update($id, ['password' => $password]);

        return redirect()->back()->with('message', "Contraseña restablecida con éxito para el usuario ID $id. Nueva contraseña: $password");
    }
}
