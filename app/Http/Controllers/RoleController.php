<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    public function index()
    {
        $roles = Role::all();
        return view('role.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('role.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $data = $this->validated();

        $permissions = $data['permissions'];
        unset($data['permissions']);

        $role = Role::create($data);
        $role->syncPermissions($permissions);
        return redirect()->route('role.index');
    }

    public function show($id)
    {
        //
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $role->load('permissions');
        return  view('role.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $data = $this->validated();

        $permissions = $data['permissions'];
        unset($data['permissions']);

        $role->update($data);
        $role->syncPermissions($permissions);
        return redirect()->route('role.index');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('role.index');
    }

    public function validated()
    {
        return request()->validate([
            'name' => 'required|min:3',
            'guard_name' => 'nullable',
            'permissions' => 'required|array'
        ]);
    }
}
