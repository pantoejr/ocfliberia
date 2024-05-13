<?php

namespace App\Livewire;

use App\Models\Beneficiary;
use App\Models\Visit;
use Livewire\Component;

class BeneficiarySelection extends Component
{
    public $visit_id;

    public function render()
    {
        if($this->visit_id){
            $visit = Visit::find($this->visit_id);
            $beneficiaries = Beneficiary::where('school_id', $visit->school_id)->get();
        }
        else{
            $beneficiaries = Beneficiary::all();
        }
        return view('livewire.beneficiary-selection',[
            'beneficiaries' => $beneficiaries,
        ]);
    }
}
