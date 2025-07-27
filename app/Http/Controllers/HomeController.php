<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use App\Models\Distribution;
use App\Models\School;
use App\Models\Sponsor;
use App\Models\Visit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function dashboard()
    {
        $sponsorCount = Sponsor::count();
        $schoolCount = School::count();
        $beneficiaryCount = Beneficiary::count();
        //$visitCount = Visit::whereYear('created_at', date('Y'))->where('is_active', true)->count();
        $visitCount = Visit::count();

        $data = Visit::select(
            's.name as sponsor_name',
            'v.sponsor_id',
            DB::raw('SUM(num_distributed) as total_distributed')
        )
            ->from('visits AS v')
            ->join('distributions AS d', 'v.id', '=', 'd.visit_id')
            ->join('sponsors AS s', 'v.sponsor_id', '=', 's.id')
            ->groupBy('v.sponsor_id', 's.name')
            ->get();

        $distributions = Distribution::select(
            DB::raw('YEAR(distribution_date) as year'),
            DB::raw('MONTHNAME(distribution_date) as month'),
            DB::raw('SUM(num_distributed) as total_distributed')
        )
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $visits = Visit::select(
            'schools.name as school_name',
            DB::raw('COUNT(visits.id) as total_visits')
        )
            ->join('schools', 'visits.school_id', '=', 'schools.id')
            ->groupBy('schools.name')
            ->orderBy('total_visits', 'desc')
            ->get();

        return view('home.dashboard', [
            'title' => 'Dashboard',
            'sponsorCount' => $sponsorCount,
            'schoolCount' => $schoolCount,
            'beneficiaryCount' => $beneficiaryCount,
            'visitCount' => $visitCount,
            'data' => $data,
            'distributions' => $distributions,
            'visits' => $visits,
        ]);
    }
}
