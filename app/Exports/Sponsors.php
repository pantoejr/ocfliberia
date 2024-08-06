<?php

namespace App\Exports;

use App\Models\Sponsor;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Sponsors implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $sponsors = Sponsor::all('id', 'name', 'email', 'contact');
        return $sponsors;
    }

    public function headings(): array
    {
        return ["ID", "Name", "Email", "Contact"];
    }
}
