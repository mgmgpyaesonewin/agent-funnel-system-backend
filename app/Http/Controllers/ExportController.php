<?php

namespace App\Http\Controllers;

use App\Exports\ApplicantExport;
use App\Exports\PMLIFilterExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function pmliFilterExport()
    {
        return Excel::download(new PMLIFilterExport(), 'applicants-pmli-filter.xlsx');
    }

    public function applicantExport(Request $request)
    {
        return Excel::download(new ApplicantExport($request->id), 'applicant.xlsx');
    }
}
