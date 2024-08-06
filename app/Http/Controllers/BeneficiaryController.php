<?php

namespace App\Http\Controllers;

use App\Exports\BeneficiariesExport;
use App\Models\Beneficiary;
use App\Models\ProjectBeneficiary;
use App\Models\School;
use App\Models\Visit;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class BeneficiaryController extends Controller
{
    public function index()
    {
        $beneficiaries = Beneficiary::all();

        return view('beneficiaries.index', [
            'title' => 'List of Students',
            'beneficiaries' => $beneficiaries,
        ]);
    }

    public function create()
    {
        $schools = School::where('is_active', true)->get();
        return view('beneficiaries.create', compact('schools'), [
            'title' => 'Create Student',
            'schools' => $schools,
        ]);
    }

    public function store(Request $request)
    {
        try {

            $request->validate([
                'fullname' => 'required',
                'school_id' => 'required',
                'age' => 'numeric|required',
                'date_of_birth' => 'required|date',
                'location' => 'required',
                'contact' => 'required',
                'class' => 'required',
                'image' => 'required',
            ]);
            $isNew = $request->is_new ? 1 : 0;
            $isActive = $request->is_active ? 1 : 0;
            $path = $request->file('image')->store('images', 'public');

            $beneficiary = new Beneficiary([
                'fullname' => $request->input('fullname'),
                'school_id' => $request->input('school_id'),
                'age' => $request->input('age'),
                'date_of_birth' => $request->input('date_of_birth'),
                'location' => $request->input('location'),
                'contact' => $request->input('contact'),
                'class' => $request->input('class'),
                'image' => $path,
                'created_by' => Auth::user()->name,
                'is_active' => $isActive,
                'is_new' => $isNew,
            ]);

            $beneficiary->save();
        } catch (\Exception $ex) {
            return back()->with('msg', $ex->getMessage())->with('flag', 'alert-danger');
        }
        return redirect('beneficiaries')->with('msg', 'Student created successfully')->with('flag', 'alert-success');
    }

    public function details($id)
    {
        $schools = School::pluck('name', 'id');
        $beneficiary = Beneficiary::find($id);
        return view('beneficiaries.details', [
            'title' => 'Student Details',
            'beneficiary' => $beneficiary,
            'schools' => $schools
        ]);
    }

    public function edit($id)
    {
        $schools = School::pluck('name', 'id');
        $beneficiary = Beneficiary::find($id);
        return view('beneficiaries.edit', [
            'title' => 'Edit Student',
            'beneficiary' => $beneficiary,
            'schools' => $schools
        ]);
    }

    public function update($id, Request $request)
    {
        try {
            $beneficiary = Beneficiary::find($id);

            if ($request->hasFile('image')) {
                if ($beneficiary->image) {
                    Storage::disk('public')->delete($beneficiary->image);
                }

                $path = $request->file('image')->store('images', 'public');
                $beneficiary->image = $path;
            } else {
                $beneficiary->image = $beneficiary->image;
            }

            $isNew = $request->is_new ? 1 : 0;
            $isActive = $request->is_active ? 1 : 0;
            $beneficiary->fullname = $request->fullname;
            $beneficiary->school_id = $request->school_id;
            $beneficiary->age = $request->age;
            $beneficiary->date_of_birth = $request->date_of_birth;
            $beneficiary->location = $request->location;
            $beneficiary->contact = $request->contact;
            $beneficiary->class = $request->class;
            $beneficiary->is_active = $isActive;
            $beneficiary->is_new = $isNew;

            $beneficiary->save();
        } catch (Exception $ex) {
            return back()->with('msg', $ex->getMessage())->with('flag', 'alert-danger');
        }
        return redirect('beneficiaries')->with('msg', 'Student updated successfully')->with('flag', 'alert-success');
    }

    public function getBeneficiaries(Request $request)
    {
        $visitId = $request->input('visit_id');
        $visit = Visit::find($visitId);
        $beneficiaries = Beneficiary::where('school_id', $visit->school_id)->where('is_active', true)->get();
        return response()->json($beneficiaries);
    }

    public function getProjectBeneficiaries(Request $request)
    {
        $visitId = $request->input('visit_id');

        $beneficiaries = ProjectBeneficiary::where('visit_id', $visitId)
            ->join('beneficiaries', 'project_beneficiaries.beneficiary_id', '=', 'beneficiaries.id')
            ->get();
        return response()->json($beneficiaries);
    }

    public function exportExcel()
    {
        return Excel::download(new BeneficiariesExport, 'Students_Report.xlsx');
    }

    public function exportPDF()
    {
        $students = Beneficiary::all();
        $pdf = PDF::loadView('reports.pdf.student-report-pdf', data: [
            'students' => $students,
            'title' => 'Student Report',
        ])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
}
