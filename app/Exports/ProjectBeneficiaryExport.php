<?php

namespace App\Exports;

use App\Models\ProjectBeneficiary;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProjectBeneficiaryExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ProjectBeneficiary::all();
    }
}
