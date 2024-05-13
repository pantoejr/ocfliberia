<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::all();
        return view('roles.index',[
            'title' => 'List of Roles',
            'roles' => $roles,
        ]);
    }

    public function create(){
        return view('roles.create',[
            'title' => 'Create Role',
        ]);
    }

    public function store(Request $request){
        $role = new Role([
            'name' => $request->input('name'),
            'created_by' => 'system',
            'is_active' => true,
        ]);

        $role->save();
        return redirect('/roles')->with('msg','Role created successfully')->with('flag','alert-success');
    }

    public function edit($id){
        $role = Role::find($id);
        return view('roles.edit',[
            'title' => 'Edit Role',
            'role' => $role,
        ]);
    }

    public function update($id, Request $request){
        $role = Role::find($id);
        $role->name = $request->name;
        $role->save();
        return redirect('/roles')->with('msg','Record updated successfully')->with('flag','alert-success');
    }


    public function destroy($id){
        $role = Role::find($id);
        $role->delete();
        return redirect('/roles')->with('msg','Record deleted successfully')->with('flag','alert-danger');
    }
}
