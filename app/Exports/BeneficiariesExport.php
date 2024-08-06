<?php

namespace App\Exports;

use App\Models\Beneficiary;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BeneficiariesExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $beneficiaries = DB::table('beneficiaries')
            ->join('schools', 'beneficiaries.school_id', '=', 'schools.id')
            ->select(
                'beneficiaries.id',
                'beneficiaries.fullname',
                'schools.name',
                'beneficiaries.age',
                'beneficiaries.date_of_birth',
                'beneficiaries.location',
                'beneficiaries.contact',
                'beneficiaries.class'
            )->get();
        return $beneficiaries;
    }

    public function headings(): array
    {
        return ["ID", "Full Name", "School Name", "Age", "Date of Birth", "Location", "Contact", "Class"];
    }
}
