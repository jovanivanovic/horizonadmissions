<?php

namespace App\Http\Controllers\Administration;

use App\Http\Requests\Administration\CreateUserFormRequest;
use App\Http\Requests\Administration\EditUserFormRequest;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();

        return view('administration.users.index', ['users' => $users]);
    }

    public function create()
    {
        $roles = Role::where('name', '!=', 'student')->get();

        return view('administration.users.create', ['roles' => $roles]);
    }

    public function store(CreateUserFormRequest $request)
    {
        $role = Role::where('name', $request->role)->first();

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password)
        ]);

        $user->attachRole($role);

        return redirect()->route('admin.users');
    }

    public function edit(User $user)
    {
        $roles = Role::all();

        return view('administration.users.edit', [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function update(EditUserFormRequest $request, User $user)
    {
        $role = Role::where('name', $request->role)->first();

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone
        ]);

        $user->detachRole($user->role);
        $user->attachRole($role);

        return redirect()->route('admin.users');
    }

    public function toggle_status(User $user)
    {
        $user->status = $user->status == 1 ? false : true;
        $user->save();

        return redirect()->route('admin.users');
    }

    public function getUserInfo(Request $request)
    {
        $user = User::find($request->user_id);

        return view('common.user-info', [
            'user' => $user
        ]);
    }
}
