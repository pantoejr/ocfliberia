<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GraduatesExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        $graduates = DB::table('graduates')
            ->join('school_types', 'graduates.school_type_id', '=', 'school_types.id')
            ->select(
                'graduates.id',
                'graduates.fullname',
                'school_types.name',
                'graduates.school_graduated',
                'graduates.class_graduated',
                'graduates.date_graduated',
            )->get();
        return $graduates;
    }

    public function headings(): array
    {
        return [
            'Id',
            'Fullname',
            'School Type',
            'School Name',
            'Class Graduated',
            'Date Graduated'
        ];
    }
}
