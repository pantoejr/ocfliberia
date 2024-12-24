<?php

namespace App\Http\Controllers;

use App\Exports\GraduatesExport;
use App\Models\Graduate;
use App\Models\SchoolType;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class GraduateController extends Controller
{
    public function index()
    {
        $graduates = Graduate::all();
        return view('graduates.index', [
            'title' => 'List of Graduates',
            'graduates' => $graduates,
        ]);
    }

    public function create()
    {
        $schoolTypes = SchoolType::pluck('name', 'id');
        return view('graduates.create', [
            'title' => 'Create Graduate',
            'schoolTypes' => $schoolTypes,
        ]);
    }

    public function store(Request $request)
    {
        try {

            $request->validate([
                'fullname' => 'required',
                'school_type_id' => 'required',
                'date_graduated' => 'required|date',
                'school_graduated' => 'required',
                'class_graduated' => 'required',
            ]);

            Graduate::create([
                'fullname' => $request->input('fullname'),
                'school_type_id' => $request->input('school_type_id'),
                'date_graduated' => $request->input('date_graduated'),
                'school_graduated' => $request->input('school_graduated'),
                'class_graduated' => $request->input('class_graduated'),
                'created_by' => Auth::user()->name,
            ]);
        } catch (Exception $ex) {
            return back()->with('msg', $ex->getMessage())->with('flag', 'alert-danger');
        }
        return redirect()->route('graduates.index')
            ->with('msg', 'Graduate created successfully')
            ->with('flag', 'alert-success');
    }

    public function details($id)
    {
        $graduate = Graduate::findOrFail($id);
        return view('graduates.details', [
            'title' => 'Graduate Details',
            'graduate' => $graduate,
        ]);
    }

    public function edit($id)
    {
        $schoolTypes = SchoolType::pluck('name', 'id');
        $graduate = Graduate::findOrFail($id);
        return view('graduates.edit', [
            'title' => 'Edit Graduate',
            'graduate' => $graduate,
            'schoolTypes' => $schoolTypes,
        ]);
    }

    public function update($id, Request $request)
    {
        try {
            $graduate = Graduate::findOrFail($id);
            $graduate->fullname = $request->input('fullname');
            $graduate->school_type_id = $request->input('school_type_id');
            $graduate->date_graduated = $request->input('date_graduated');
            $graduate->school_graduated = $request->input('school_graduated');
            $graduate->class_graduated = $request->input('class_graduated');
            $graduate->save();
        } catch (Exception $ex) {
            return back()->with('msg', $ex->getMessage())->with('flag', 'alert-danger');
        }
        return redirect()->route('graduates.index')
            ->with('msg', 'Graduate updated successfully')
            ->with('flag', 'alert-success');
    }

    public function destroy($id)
    {
        $graduate = Graduate::findOrFail($id);
        $graduate->delete();
        return redirect()->route('graduates.index')
            ->with('msg', 'Graduate deleted successfully')
            ->with('flag', 'alert-success');
    }

    public function exportExcel()
    {
        return Excel::download(new GraduatesExport, 'GraduateReport.xlsx');
    }

    public function exportPDF()
    {
        $graduates = Graduate::all();
        $pdf = Pdf::loadView('reports.pdf.graduates-report', data: [
            'graduates' => $graduates,
            'title' => 'Graduate Report',
        ])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
}
