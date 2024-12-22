<?php

namespace App\Exports;

use App\Models\Dropout;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCharts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DropoutsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $dropouts = Dropout::all([
            'id',
            'fullname',
            'class',
            'reason',
            'date_dropout'
        ]);
        return $dropouts;
    }
    public function headings(): array
    {
        return ["ID", "Fullname", "Class", "Reason", "Date Dropped"];
    }
}
