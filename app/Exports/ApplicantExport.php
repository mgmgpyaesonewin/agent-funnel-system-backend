<?php

namespace App\Exports;

use App\Applicant;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ApplicantExport implements FromView
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        return view('pages.applicants.detail_export', [
            'applicant' => Applicant::where('id', $this->id)->first(),
        ]);
    }
}
