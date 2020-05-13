<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

//    public function __construct()
//    {
//        $this->middleware('can:create_permission')->only('create', 'store');
//    }

    public function index()
    {
        $permissions = Permission::all();
        return view('permission.index', compact('permissions'));
    }

    public function create()
    {
        return view('permission.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated();

        Permission::create($data);
        return redirect()->route('permission.index');
    }

    public function show($id)
    {
        //
    }

    public function edit(Permission $permission)
    {
        return view('permission.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $data = $this->validated();

        $permission->update($data);
        return redirect()->route('permission.index');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return back();
    }

    public function validated()
    {
        return request()->validate([
            'name' => 'required|min:3',
            'guard_name' => 'nullable'
        ]);
    }
}
