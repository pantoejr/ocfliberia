<?php

namespace App\Livewire;

use App\Models\Beneficiary;
use App\Models\School;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;

class StudentReport extends Component
{

    public $schoolId;

    public function render()
    {
      $schools = School::where('is_active', true)->get();
      $schoolId = $this->schoolId;
      if ($schoolId) {
        $students = Beneficiary::where('school_id',$schoolId)->get();
      }else{
        $students = [];
      }
      return view('livewire.student-report', [
        'schools' => $schools,
        'students' => $students,
      ]);
    }

    public function updateTable(){
        $schoolId = $this->schoolId;
    }

    public function download(){
        $beneficiaries = Beneficiary::where('school_id', $this->schoolId)->get();
        $pdf = PDF::loadView('reports.pdf.student-report-pdf', data:[
            'beneficiaries' => $beneficiaries,
            'title' => 'Project Beneficiaries',
        ])->setPaper('a4', 'portrait');

        return $pdf->download('student_report.pdf');
    }

}
