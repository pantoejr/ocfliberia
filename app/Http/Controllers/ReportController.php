<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use App\Models\Distribution;
use App\Models\School;
use App\Models\Sponsor;
use App\Models\Visit;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function distributions(Request $request)
    {
        if ($request->startDate != null && $request->endDate != null) {

            $startDate = $request->startDate;
            $endDate = $request->endDate;
            $distributions = Distribution::whereBetween('distribution_date', [$startDate, $endDate])->get();
            return view('reports.distributions', [
                'title' => 'Distribution Report',
                'distributions' => $distributions,
            ]);
        }
        $distributions = Distribution::all();
        return view('reports.distributions', [
            'title' => 'Distributions Report',
            'distributions' => $distributions,
        ]);
    }

    public function students(Request $request)
    {
        if ($request->startDate != null && $request->endDate != null) {
            $startDate = $request->startDate;
            $endDate = $request->endDate;
            $students = Beneficiary::whereBetween('created_at', [$startDate, $endDate])->get();
            return view('reports.students', [
                'title' => 'Student Report',
                'students' => $students,
            ]);
        }
        $students = Beneficiary::all();
        return view('reports.students', [
            'title' => 'Student Report',
            'students' => $students,
        ]);
    }

    public function visits(Request $request)
    {
        if ($request->startDate != null && $request->endDate != null) {
            $startDate = $request->startDate;
            $endDate = $request->endDate;
            $visits = Visit::whereBetween('visit_date', [$startDate, $endDate])->get();
            return view('reports.visits', [
                'title' => 'Visits Report',
                'visits' => $visits,
            ]);
        }

        $visits = Visit::all();
        return view('reports.visits', [
            'title' => 'Visits Report',
            'visits' => $visits,
        ]);
    }

    public function sponsors(Request $request)
    {
        if ($request->startDate != null && $request->endDate != null) {
            $startDate = $request->startDate;
            $endDate = $request->endDate;
            $visits = Visit::whereBetween('created_at', [$startDate, $endDate])->get();
            return view('reports.sponsors', [
                'title' => 'Sponsors Report',
                'visits' => $visits,
            ]);
        }

        $sponsors = Sponsor::all();
        return view('reports.sponsors', [
            'title' => 'Sponsors Report',
            'sponsors' => $sponsors,
        ]);
    }

    public function institutions(Request $request)
    {
        if ($request->startDate != null && $request->endDate != null) {
            $startDate = $request->startDate;
            $endDate = $request->endDate;
            $institutions = School::whereBetween('created_at', [$startDate, $endDate])->get();
            return view('reports.institutions', [
                'title' => 'Institutions Report',
                'visits' => $institutions,
            ]);
        }

        $institutions = School::all();
        return view('reports.institutions', [
            'title' => 'Institutions Report',
            'institutions' => $institutions,
        ]);
    }
}
