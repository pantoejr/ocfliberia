<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Sponsor;
use App\Models\Visit;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitController extends Controller
{
    public function index(){
        $visits = Visit::all();
        $title = "List of Visits";
        return view('visits.index',compact('visits', 'title'));
    }

    public function create(){
        $sponsors = Sponsor::pluck('name','id');
        $schools = School::pluck('name','id');
        $title = "Create Visit";
        return view('visits.create',compact('sponsors','schools','title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'visit_date' => 'required|date',
            'description' => 'required|string',
        ]);

        $visit = new Visit([
            'name' => $request->name,
            'school_id' => $request->school_id,
            'visit_date' => $request->visit_date,
            'sponsor_id' => $request->sponsor_id,
            'description' => $request->description,
            'is_active' => true,
            'created_by' => Auth::user()->name,
        ]);

        $visit->save();

        return redirect('visits')->with('msg', 'visit updated successfully')->with('flag', 'alert-success');
    }

    public function edit($id){
        $visit =  Visit::find($id);
        $sponsors = Sponsor::pluck('name','id');
        $schools = School::pluck('name','id');
        $title = "Edit Visit";
        return view('visits.edit',compact('visit','sponsors','schools','title'));
    }

    public function update($id, Request $request){
        try {

            $visit = Visit::find($id);
            $visit->name = $request->name;
            $visit->school_id = $request->school_id;
            $visit->visit_date = $request->visit_date;
            $visit->sponsor_id = $request->sponsor_id;
            $visit->description = $request->description;
            $visit->is_active = true;
            $visit->save();

        return redirect('visits')->with('msg','Visit updated successfully')->with('flag','alert-success');
        } catch (Exception $ex) {
            return back()->with('msg','Error: '.$ex->getMessage())->with('flag','alert-danger');
        }
    }

    public function details($id){
        $visit =  Visit::find($id);
        $sponsors = Sponsor::pluck('name','id');
        $schools = School::pluck('name','id');
        $title = "Visit Details";
        return view('visits.details',compact('visit','sponsors','schools','title'));
    }

    public function destroy($id){
        $visit =  Visit::find($id);
        $visit->delete();
        return redirect('visits')->with('msg','Visit deleted successfully')->with('flag','alert-success');
    }
}
