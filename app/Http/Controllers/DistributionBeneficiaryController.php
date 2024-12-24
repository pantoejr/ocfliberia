<?php

namespace App\Http\Controllers;

use App\Models\ProjectBeneficiary;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class DistributionBeneficiaryController extends Controller
{
    public function index()
    {
        $distributionBeneficiaries = ProjectBeneficiary::all();
        return view('distributionbeneficiaries.index', [
            'title' => 'Distribution Beneficiaries',
            'distributionBeneficiaries' => $distributionBeneficiaries,
        ]);
    }

    public function viewPdf()
    {
        $beneficiaries = ProjectBeneficiary::all();

        $pdf = PDF::loadView('distributionbeneficiaries.viewPdf', data: [
            'beneficiaries' => $beneficiaries,
            'title' => 'Project Beneficiaries',
        ])
            ->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
}
