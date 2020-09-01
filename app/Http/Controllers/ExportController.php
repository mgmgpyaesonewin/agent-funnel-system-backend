<?php

namespace App\Http\Controllers;

use App\Exports\ApplicantExport;
use App\Exports\ApplicantsExport;
use App\Exports\PMLIFilterExport;
use App\Imports\ApplicantsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
}
