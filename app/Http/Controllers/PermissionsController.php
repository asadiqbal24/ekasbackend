<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $permissions = Permission::all();

        return view('permissions.index', [
            'permissions' => $permissions
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create() 
    {   
        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
    {   
        $request->validate([
            'name' => 'required|unique:permissions,name'
        ]);
        

        Permission::create($request->only('name'));

        return redirect()->route('permissions-index')
            ->withSuccess(__('Permission created successfully.'));
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
    public function edit($id)
    {
    $permission = Permission::find($id);
      
        return view('permissions.edit', [
            'permission' => $permission
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $permission = Permission::find($request->id);
        $request->validate([
            'name' => 'required|unique:permissions,name,'.$permission->id
        ]);

        $permission->update($request->only('name'));

        return redirect()->route('permissions-index')
            ->withSuccess(__('Permission updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $permission = Permission::find($id);
        $permission->delete();

        return redirect()->route('permissions-index')
            ->withSuccess(__('Permission deleted successfully.'));
    }
}
