<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\users\store;
use App\Http\Requests\users\update;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $users = User::where('name', '!=', 'Admin')
            ->latest()
            ->paginate($perPage);

        return inertia("Users/Index", [
            "users" => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Users/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(store $request)
    {
        $data = $request->validated();
        User::create($data);

        return redirect(route('users-master.index'))->with([
            'message' => 'Data Successfully Created!'
        ]);
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
    public function edit(User $user)
    {
        return inertia('Users/Edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Update $request, User $user)
    {
        $user->update($request->all());

        return redirect(route('users-master.index'))->with([
            'message' => 'Data Successfully Created!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect(route('users-master.index'))->with([
            'message' => 'data deleted!'
        ]);
    }
}
