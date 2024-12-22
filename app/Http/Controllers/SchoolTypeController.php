<?php

namespace App\Http\Controllers;

use App\Models\SchoolType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchoolTypeController extends Controller
{
    public function index()
    {
        $schoolTypes = SchoolType::all();
        return view('schooltypes.index', [
            'title' => 'List of School Types',
            'schoolTypes' => $schoolTypes,
        ]);
    }

    public function create()
    {
        return view('schooltypes.create', [
            'title' => 'Create School Type'
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required'
            ]);
            SchoolType::create([
                'name' => $request->input('name'),
                'created_by' => Auth::user()->name,
            ]);
        } catch (Exception $ex) {
            return back()->with('msg', $ex->getMessage())->with('flag', 'alert-danger');
        }
        return redirect()->route('schooltypes.index')->with('msg', 'School Type created successfully')->with('flag', 'alert-success');
    }

    public function edit($id)
    {
        $schoolType = SchoolType::findOrFail($id);
        return view('schooltypes.edit', [
            'title' => 'Edit School Type',
            'schoolType' => $schoolType,
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $schoolType = SchoolType::findOrFail($id);
            $schoolType->name = $request->input('name');
            $schoolType->save();
        } catch (Exception $ex) {
            return back()->with('msg', $ex->getMessage())->with('flag', 'alert-danger');
        }
        return redirect()->route('schooltypes.index')->with('msg', 'School Type updated successfully')->with('flag', 'alert-success');
    }

    public function destroy($id)
    {
        $schoolType = SchoolType::findOrFail($id);
        $schoolType->delete();
        return redirect()->route('schooltypes.index')->with('msg', 'School Type deleted successfully')->with('flag', 'alert-success');
    }
}
