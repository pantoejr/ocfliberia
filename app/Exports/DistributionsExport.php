<?php

namespace App\Exports;

use App\Models\Distribution;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DistributionsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $distributions = DB::table('distributions')->join('visits', 'visits.name', '=', '')->get();
    }

    public function headings(): array
    {
        return [];
    }
}
