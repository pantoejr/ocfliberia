<?php

namespace App\Http\Controllers;

use App\Exports\DropoutsExport;
use App\Models\Dropout;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class DropoutController extends Controller
{
    public function index()
    {
        $dropouts = Dropout::all();
        return view('dropouts.index', [
            'dropouts' => $dropouts,
            'title' => 'List of Dropouts',
        ]);
    }

    public function create()
    {
        return view('dropouts.create', [
            'title' => 'Create Dropouts',
        ]);
    }

    public function store(Request $request)
    {
        try {

            $request->validate([
                'fullname' => 'required',
                'reason' => 'required',
                'date_dropout' => 'required',
                'class' => 'required'
            ]);

            Dropout::create([
                'fullname' => $request->input('fullname'),
                'reason' => $request->input('reason'),
                'date_dropout' => $request->input('date_dropout'),
                'class' => $request->input('class'),
                'created_by' => Auth::user()->name,
            ]);
        } catch (Exception $ex) {
            return back()->with('msg', $ex->getMessage())->with('flag', 'alert-danger');
        }
        return redirect()->route('dropouts.index')
            ->with('msg', 'Dropout created successfully')
            ->with('flag', 'alert-success');
    }

    public function details($id)
    {
        $dropout = Dropout::findOrFail($id);
        return view('dropouts.details', [
            'title' => 'Dropout Details',
            'dropout' => $dropout,
        ]);
    }

    public function edit($id)
    {
        $dropout = Dropout::findOrFail($id);
        return view('dropouts.edit', [
            'title' => 'Edit Dropout',
            'dropout' => $dropout,
        ]);
    }

    public function update($id, Request $request)
    {
        try {
            $dropout = Dropout::findOrFail($id);
            $dropout->fullname = $request->input('fullname');
            $dropout->class = $request->input('class');
            $dropout->date_dropout = $request->input('date_dropout');
            $dropout->reason = $request->input('reason');
            $dropout->save();
        } catch (\Exception $ex) {
            return redirect()->back()->with('msg', $ex->getMessage())->with('flag', 'alert-danger');
        }
        return redirect()->route('dropouts.index')
            ->with('msg', 'Dropout updated successfully')
            ->with('flag', 'alert-success');
    }

    public function destroy($id)
    {
        try {
            $dropout = Dropout::findOrFail($id);
            $dropout->delete();
        } catch (Exception $ex) {
            return back()->with('msg', $ex->getMessage())->with('flag', 'alert-danger');
        }
        return redirect()->route('dropouts.index')->with('msg', 'Dropout deleted successfully')->with('flag', 'alert-success');
    }

    public function exportExcel()
    {
        return Excel::download(new DropoutsExport, 'Dropout.xlsx');
    }

    public function exportPDF()
    {
        $dropouts = Dropout::all();
        $pdf = Pdf::loadView('reports.pdf.dropout-report', data: [
            'dropouts' => $dropouts,
            'title' => 'Dropout Report',
        ])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
}
