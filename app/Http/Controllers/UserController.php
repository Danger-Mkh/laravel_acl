<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('user.edit', compact('user','roles'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'roles' => 'array'
        ]);

        $roles = [];
        if($request->has('roles')) {
            $roles = $data['roles'];
            unset($data['roles']);
        }

        $user->update($data);
        $user->syncRoles($roles);
        return redirect()->route('user.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }
}
