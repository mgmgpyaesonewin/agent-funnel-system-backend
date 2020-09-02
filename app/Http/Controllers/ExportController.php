<?php

namespace App\Http\Controllers;

use App\Applicant;
use App\Exports\ApplicantExport;
use App\Exports\ApplicantsExport;
use App\Exports\PMLIFilterExport;
use App\Imports\ApplicantsImport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class ExportController extends Controller
{
    public function pmliFilterExport()
    {
        return Excel::download(new PMLIFilterExport(), 'applicants-pmli-filter.xlsx');
    }

    public function applicantsExport()
    {
        return Excel::download(new ApplicantsExport(), 'applicants.xlsx');
    }

    public function applicantsImport(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new ApplicantsImport(), $request->file('file'));

        return redirect()->back()->with('message', 'All Applicants are updated successfully');
    }

    public function applicantExport(Request $request)
    {
        return Excel::download(new ApplicantExport($request->id), 'applicant.xlsx');
    }

    public function pdf(Request $request)
    {
        $applicant = Applicant::where('id', 2)->first();
        $applicant->agreement_no = $applicant->temp_id;
        $applicant->signed_date = Carbon::now();

        view()->share('applicant', $applicant);
        $pdf = PDF::loadView('pages.pdf', $applicant);

        return $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->stream('contract.pdf');
    }
}
