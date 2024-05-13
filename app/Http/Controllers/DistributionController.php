<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use App\Models\Distribution;
use App\Models\DistributionType;
use App\Models\ProjectBeneficiary;
use App\Models\Visit;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DistributionController extends Controller
{
    public function index()
    {
        $distributions = Distribution::all();
        $title = "List of Distributions";
        return view('distributions.index', compact('title', 'distributions'));
    }

    public function create()
    {
        $visits = Visit::pluck('name', 'id');
        $distributionTypes = DistributionType::pluck('name', 'id');
        $title = "Create Distribution";
        return view('distributions.create', compact('visits', 'distributionTypes', 'title'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'distribution_date' => 'required|date',
                'beneficiaries' => 'required|array', // Ensure beneficiaries are provided
            ]);

            $beneficiaries = $request->input('beneficiaries');

            $distribution = new Distribution([
                'visit_id' => $request->input('visit_id'),
                'distribution_type_id' => $request->input('distribution_type_id'),
                'distribution_date' => $request->input('distribution_date'),
                'num_distributed' => count($beneficiaries),
                'created_by' => Auth::user()->name,
                'is_active' => true,
            ]);

            $distribution->save();

            // Insert beneficiaries into project_beneficiaries table
            foreach ($request->input('beneficiaries') as $beneficiaryId) {
                $projectBeneficiary = new ProjectBeneficiary();
                $projectBeneficiary->visit_id = $distribution->visit_id;
                $projectBeneficiary->beneficiary_id = $beneficiaryId;
                $projectBeneficiary->distribution_id = $distribution->id; // Link the beneficiary to the distribution
                $projectBeneficiary->save();
            }
        } catch (Exception $ex) {
            return back()->with('msg', 'Error: ' . $ex->getMessage())->with('flag', 'alert-danger');
        }

        return redirect('distributions')->with('msg', 'Distribution recorded successfully')->with('flag', 'alert-success');
    }

    public function edit($id)
    {
        $distribution = Distribution::find($id);
        $visits = Visit::pluck('name', 'id');
        $distributionTypes = DistributionType::pluck('name', 'id');
        $title = "Edit Distribution";
        return view('distributions.edit', compact('distribution', 'visits', 'distributionTypes', 'title'));
    }

    public function destroy($id)
    {
        try {
            $distribution = Distribution::find($id);
            $distribution->delete();
        } catch (\Exception $ex) {
            return back()->with('msg', $ex->getMessage())->with('flag','alert-danger');
        }

        return redirect('distributions')->with('msg', 'Distribution deleted successfully')->with('flag', 'alert-danger');
    }

    public function details($id)
    {
        $distribution = Distribution::find($id);
        $visits = Visit::pluck('name', 'id');
        $distributionTypes = DistributionType::pluck('name', 'id');
        $title = "Distribution Details";
        return view('distributions.details', compact('distribution', 'title', 'visits', 'distributionTypes'));
    }
}
