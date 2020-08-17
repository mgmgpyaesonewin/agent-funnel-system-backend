<?php

namespace App\Exports;

use App\Applicant;
use Maatwebsite\Excel\Concerns\FromCollection;

class PMLIFilterExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Applicant::where('current_status', 'pmli_filter')->get();
    }
}
