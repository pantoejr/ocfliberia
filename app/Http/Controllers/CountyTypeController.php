<?php

namespace App\Http\Controllers;

use App\Models\CountyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Constraint\Count;

class CountyTypeController extends Controller
{
    public function index(){
        $counties = CountyType::all();
        return view('countytype.index',[
            'title' => 'List of Counties',
            'counties' => $counties,
        ]);
    }

    public function create(){
        return view('countytype.create',[
            'title' => 'Create County'
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
        ]);
        $is_active = $request->is_active ? 1 : 0;

        $county = new CountyType([
            'name' => $request->input('name'),
            'is_active' => $is_active,
            'created_by' => Auth::user()->name,
        ]);

        $county->save();

        return redirect('counties')->with('msg', 'county created successfully')->with('flag', 'alert-success');
    }

    public function edit($id){
        $county = CountyType::find($id);
        return view('countytype.edit',[
            'title' => 'Edit County',
            'county' => $county,
        ]);
    }

    public function update($id, Request $request){
        $county = CountyType::find($id);
        $county->name = $request->name;
        $county->is_active = $request->is_active;
        $county->save();
        return redirect('counties')->with('msg', 'county updated successfully')->with('flag', 'alert-success');
    }

    public function destroy($id){
        $county = CountyType::find($id);
        $county->delete();
        return redirect('counties')->with('msg', 'county deleted successfully')->with('flag', 'alert-danger');
    }
}
