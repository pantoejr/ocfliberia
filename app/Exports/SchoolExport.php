<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class SchoolExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $schools = DB::table('schools')
            ->join('county_types', 'schools.county_id', '=', 'county_types.id')
            ->join('sponsors', 'schools.sponsor_id', '=', 'sponsors.id')
            ->select(
                'schools.id',
                'schools.name as school_name',
                'county_types.name as county_name',
                'sponsors.name as sponsor_name',
                'schools.total_girls as total_girls',
            )->get();
        return $schools;
    }
    public function headings(): array
    {
        return ["id", "school_name", "county_name", "sponsor_name", "total_girls"];
    }
}
