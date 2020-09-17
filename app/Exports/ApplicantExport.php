<?php

namespace App\Exports;

use App\Applicant;
use App\Training;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ApplicantExport implements FromView
{
    private $id;
    private $type;

    public function __construct($type, $id)
    {
        $this->id = $id;
        $this->type = $type;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        if($this->type == 'pdf')
            $page = 'pages.applicants.detail_pdf';
        else
            $page = 'pages.applicants.detail_export';

        return view($page, [
            'applicant' => Applicant::where('id', $this->id)->first(),
            'trainings' => Training::all(),
        ]);
    }
}
