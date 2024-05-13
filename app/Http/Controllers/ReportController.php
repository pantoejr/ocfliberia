<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use App\Models\Distribution;
use App\Models\Sponsor;
use App\Models\Visit;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function distributions(){
        $distributions = Distribution::all();
        return view('reports.distributions',[
            'title' => 'Report Distributions',
            'distributions' => $distributions,
        ]);
    }

    public function students(){
        $students = Beneficiary::all();
        return view('reports.students',[
            'title' => 'Student Report',
            'students' => $students,
        ]);
    }

    public function visits(){
        $visits = Visit::all();
        return view('reports.visits',[
            'title' => 'Visits Report',
            'visits' => $visits,
        ]);
    }

    public function sponsors(){
        $sponsors = Sponsor::all();
        return view('reports.sponsors',[
            'title' => 'Sponsors Report',
            'sponsors' => $sponsors,
        ]);
    }
}
