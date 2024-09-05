<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
       
        $roles = Role::orderBy('id','DESC')->paginate(5);
        return view('roles.index',compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::get();
        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //dd($request);
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

    
        $role = Role::create(['name' => $request->get('name')]);
        $role->syncPermissions($request->get('permission'));
    
        return redirect()->route('roles-index')
                        ->with('success','Role created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       
        $role = Role::find($id);
       
        $rolePermissions = $role->permissions;
    
        return view('roles.show', compact('role', 'rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {   
        $role = Role::find($id);
       
        $rolePermissions = $role->permissions->pluck('name')->toArray();
        $permissions = Permission::get();
    
        return view('roles.edit', compact('role', 'rolePermissions', 'permissions'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $role = Role::find($request->id);
       
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
        
        $role->update($request->only('name'));
    
        $role->syncPermissions($request->get('permission'));
    
        return redirect()->route('roles-index')
                        ->with('success','Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')
                        ->with('success','Role deleted successfully');
    }
}
