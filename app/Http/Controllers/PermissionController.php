<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(){
        $permissions = Permission::all();
        return view('permissions.index',[
            'title' => 'List of Permissions',
            'permissions' => $permissions,
        ]);
    }

    public function create(){
        return view('permissions.create',[
            'title' => 'Create Permission',
        ]);
    }

    public function store(Request $request){
        $permission = new Permission([
            'name' => $request->input('name'),
        ]);

        $permission->save();
        return redirect('/permissions')->with('msg','Permission created successfully')->with('flag','alert-success');
    }

    public function edit($id){
        $permission = Permission::find($id);
        return view('permissions.edit',[
            'title' => 'Edit Permission',
            'permission' => $permission,
        ]);
    }

    public function update($id, Request $request){
        $permission = Permission::find($id);
        $permission->name = $request->name;
        $permission->save();
        return redirect('/permissions')->with('msg','Permission updated successfully')->with('flag','alert-success');
    }


    public function destroy($id){
        $role = Permission::find($id);
        $role->delete();
        return redirect('/permissions')->with('msg','Permission deleted successfully')->with('flag','alert-danger');
    }
}
