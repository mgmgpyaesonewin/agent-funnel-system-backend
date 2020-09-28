<?php

namespace App\Exports;

use App\Applicant;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class DCMSApplicantsExport implements FromView
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
        $applicants = Applicant::with(['statuses', 'partner'])
            ->whereBetween('created_at', [Carbon::parse($this->from), Carbon::parse($this->to)])->get();

        $applicants = $applicants->map(function ($applicant) {
            $employments = json_decode($applicant->employment);
            $applicant->employments = collect($employments)->sortBy('duration_to_date')->all();

            return $applicant;
        });

        $max_employments = 0;

        foreach ($applicants as $applicant) {
            $employments = $applicant->employments;
            $employment_length = count($employments);
            if ($employment_length > $max_employments) {
                $max_employments = $employment_length;
            }
        }

        return view('pages.exports.dcms', [
            'applicants' => $applicants,
            'max_employments' => $max_employments,
        ]);
    }
}
