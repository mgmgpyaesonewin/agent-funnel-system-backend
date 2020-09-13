<?php

namespace App\Http\Controllers;

use DB;
use App\Applicant;
use App\ImportHistory;
use App\Exports\ApplicantExport;
use App\Exports\ApplicantsExport;
use App\Exports\PMLIFilterExport;
use App\Imports\ApplicantsImport;
use App\Exports\ImportBackupExport;
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
        
        // get imported data
        $imported = (new ApplicantsImport)->toCollection($request->file('file'));
        
        // get uuids from imported file to fetch orginal data
        $ids = $imported[0]->pluck('no')->toArray();
        $org_data = Applicant::with(['statuses', 'partner'])->select(
            'uuid',
            'name',
            'phone',
            'email',
            'gender',
            'nrc',
            'address',
            'dob',
            'aml_check',
            'current_status',
            'status_id',
            'partner_id'
        )->whereIn('uuid', $ids)->get();
        
        // Update DB 
        $import = new ApplicantsImport;
        Excel::import($import, $request->file('file'));

        // get imported result
        $updated = collect([$import->getImportResult()]);
        
        $filename = 'ImportHistory'.date('dMY').'_'.date('his').'.xlsx';
        Excel::store(new ImportBackupExport($org_data, $updated), $filename , 'upload');
        
        // save filename to db
        $history = new ImportHistory;
        $history->file_name = $filename;
        $history->save();
        
        return redirect('/setting')->with('status', 'Successfully Imported.');
    }

    public function applicantExport(Request $request)
    {
        return Excel::download(new ApplicantExport($request->id), 'applicant.xlsx');
    }

    public function pdf(Request $request)
    {
        $applicant = Applicant::where('id', 2)->first();
        $applicant->agreement_no = $applicant->temp_id;
        $applicant->signed_date = Carbon::now()->format('d-m-Y');               

        view()->share('applicant', $applicant);
        $pdf = PDF::loadView('pages.pdf', $applicant);

        return $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->stream('contract.pdf');
    }
}
