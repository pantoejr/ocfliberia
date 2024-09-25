<?php

namespace App\Http\Controllers;

use App\Exports\SchoolExport;
use App\Models\CountyType;
use App\Models\School;
use App\Models\Sponsor;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class SchoolController extends Controller
{
    public function index()
    {
        $schools = School::all();
        return view('schools.index', [
            'title' => 'List of Schools',
            'schools' => $schools,
        ]);
    }

    public function create()
    {
        $sponsors = Sponsor::where('is_active', true)->get();
        $counties = CountyType::where('is_active', true)->get();
        return view('schools.create', compact('sponsors', 'counties'), [
            'title' => 'Create School',
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'location' => 'required'
            ]);

            $isActive = $request->is_active ? 1 : 0;
            $school = new School([
                'name' => $request->name,
                'location' => $request->location,
                'county_id' => $request->county_id,
                'sponsor_id' => $request->sponsor_id,
                'total_girls' => $request->total_girls,
                'created_by' => Auth::user()->name,
                'is_active' => $isActive,
            ]);

            $school->save();
        } catch (Exception $ex) {
            return back()->with('msg', $ex->getMessage())->with('flag', 'alert-danger');
        }
        return redirect('schools')->with('msg', 'School created successfully')->with('flag', 'alert-success');
    }

    public function edit($id)
    {
        $school = School::find($id);
        $sponsors = Sponsor::pluck('name', 'id');
        $counties = CountyType::pluck('name', 'id');
        return view('schools.edit', compact('sponsors', 'counties'), [
            'title' => 'Edit School',
            'school' => $school
        ]);
    }

    public function update($id, Request $request)
    {

        try {
            $isActive = $request->is_active ? 1 : 0;
            $school = School::find($id);
            $school->name = $request->name;
            $school->county_id = $request->county_id;
            $school->sponsor_id = $request->sponsor_id;
            $school->total_girls = $request->total_girls;
            $school->is_active = $isActive;
            $school->location = $request->location;

            $school->save();
        } catch (Exception $ex) {
            return back()->with('msg', $ex->getMessage())->with('flag', 'alert-danger');
        }
        return redirect('schools')->with('msg', 'School updated successfully')->with('flag', 'alert-success');
    }

    public function details($id)
    {
        $school = School::find($id);
        $sponsors = Sponsor::pluck('name', 'id');
        $counties = CountyType::pluck('name', 'id');
        return view('schools.details', compact('sponsors', 'counties'), [
            'title' => 'Edit School',
            'school' => $school
        ]);
    }

    public function destroy($id)
    {
        $school = School::find($id);
        $school->delete();
        return redirect('schools')->with('msg', 'School deleted successfully')->with('flag', 'alert-danger');
    }

    public function exportExcel()
    {
        return Excel::download(new SchoolExport, 'School_Export.xlsx');
    }

    public function exportPDF()
    {
        $schools = School::all();
        $pdf = Pdf::loadView('reports.pdf.school', data: [
            'schools' => $schools,
            'title' => 'Schools Report',
        ])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
}
