<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:create_role')->only('create', 'store');
        $this->middleware('can:edit_role')->only('edit', 'update');
        $this->middleware('can:delete_role')->only('destroy');
    }

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

    public function store()
    {
        $data = $this->validated();

        $permissions = $data['permissions'];
        unset($data['permissions']);

        $role = Role::create($data);
        $role->syncPermissions($permissions);

        return redirect()->route('role.index');
    }

    public function validated()
    {
        return request()->validate(['name' => 'required|min:3',
                                    'guard_name' => 'nullable',
                                    'permissions' => 'required|array',]);
    }

    public function show($id)
    {
        //
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $role->load('permissions');

        return view('role.edit', compact('role', 'permissions'));
    }

    public function update(Role $role)
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
}
