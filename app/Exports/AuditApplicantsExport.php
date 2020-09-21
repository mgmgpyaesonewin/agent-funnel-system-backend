<?php

namespace App\Exports;

use App\Applicant;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class AuditApplicantsExport implements FromView
{
    use Exportable;

    private $from;
    private $to;

    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
    }
    
    public function view(): View
    {
        return view('pages.exports.audit', [
            'applicants' => Applicant::with(['statuses', 'partner'])
                ->whereBetween('created_at', [Carbon::parse($this->from), Carbon::parse($this->to)])
                ->get()
        ]);
    }
}
