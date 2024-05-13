<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SponsorController extends Controller
{
    public function index(){
        $sponsors = Sponsor::all();
        return view('sponsors.index',[
            'title' => 'List of Sponsors',
            'sponsors' => $sponsors,
        ]);
    }

    public function create(){
        return view('sponsors.create',[
            'title' => 'Create Sponsor'
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'contact' => 'required',
        ]);

        $is_active = $request->is_active ? 1 : 0;

        $sponsor = new Sponsor([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'contact' => $request->input('contact'),
            'created_by' => Auth::user()->name,
            'is_active' => $is_active,
        ]);

        $sponsor->save();
        return redirect('sponsors')->with('msg','sponsor created successfully')->with('flag','alert-success');
    }

    public function edit($id){
        $sponsor = Sponsor::find($id);
        return view('sponsors.edit',compact('sponsor'),[
            'title' => 'Edit Sponsor'
        ]);
    }

    public function update($id, Request $request){
        $sponsor = Sponsor::find($id);
        $sponsor->name = $request->name;
        $sponsor->email = $request->email;
        $sponsor->contact = $request->contact;
        $sponsor->is_active = $request->is_active;

        $sponsor->save();

        return redirect('sponsors')->with('msg','sponsor update successfully')->with('flag','alert-success');
    }

    public function destroy($id){
        $sponsor = Sponsor::find($id);
        $sponsor->delete();
        return redirect('sponsors')->with('msg','sponsor deleted successfully')->with('flag','alert-danger');
    }
}
