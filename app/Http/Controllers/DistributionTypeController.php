<?php

namespace App\Http\Controllers;

use App\Models\DistributionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DistributionTypeController extends Controller
{
    public function index(){
        $distributiontypes = DistributionType::all();
        return view('distributiontype.index',[
            'title' => 'List of Distribution Types',
            'distributiontypes' => $distributiontypes,
        ]);
    }

    public function create(){
        return view('distributiontype.create',[
            'title' => 'Create Distribution Type'
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
        ]);
        $is_active = $request->is_active ? 1 : 0;

        $distributiontype = new DistributionType([
            'name' => $request->input('name'),
            'is_active' => $is_active,
            'created_by' => Auth::user()->name,
        ]);

        $distributiontype->save();

        return redirect('distributiontypes')->with('msg', 'distribution type created successfully')->with('flag', 'alert-success');
    }

    public function edit($id){
        $distributiontype = DistributionType::find($id);
        return view('distributiontype.edit',[
            'title' => 'Edit Distribution Type',
            'distributiontype' => $distributiontype,
        ]);
    }

    public function update($id, Request $request){
        $distributiontype = DistributionType::find($id);
        $distributiontype->name = $request->name;
        $distributiontype->is_active = $request->is_active;
        $distributiontype->save();
        return redirect('distributiontypes')->with('msg', 'distribution type updated successfully')->with('flag', 'alert-success');
    }

    public function destroy($id){
        $distributiontype = DistributionType::find($id);
        $distributiontype->delete();
        return redirect('distributiontypes')->with('msg', 'distribution type deleted successfully')->with('flag', 'alert-danger');
    }
}
