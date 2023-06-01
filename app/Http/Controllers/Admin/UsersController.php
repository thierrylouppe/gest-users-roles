<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
{
    // Fonction constructrice pour verifier si le User est auth 
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //Verification des droits d'accès si non redirige à la page index
        if (Gate::denies('edit-users')) {
            return redirect()->route('admin.users.index');
        }

        $roles = Role::all();

        return view('admin.users.edit', 
        [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //Synchronisation des roles selectionnés 
        $user->roles()->sync($request->roles);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //Verification des droits d'accès si non redirige à la page index
        if (Gate::denies('delete-users')) {
            return redirect()->route('admin.users.index');
        } 

        $user->roles()->detach();
        $user->delete(); 

        return redirect()->route('admin.users.index');
    }
}
