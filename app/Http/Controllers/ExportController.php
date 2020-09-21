<?php

namespace App\Http\Controllers;

use App\Applicant;
use App\Exports\ApplicantExport;
use App\Exports\ApplicantsExport;
use App\Exports\ImportBackupExport;
use App\Exports\PMLIFilterExport;
use App\Exports\PruDnaAmlCheckApplicantsExport;
use App\Exports\AuditApplicantsExport;
use App\Exports\DCMSApplicantsExport;
use App\ImportHistory;
use App\Imports\ApplicantsImport;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class ExportController extends Controller
{
    public function pmliFilterExport()
    {
        return Excel::download(new PMLIFilterExport(), 'applicants-pmli-filter.xlsx');
    }

    public function applicantsExport(Request $request)
    {
        $fromDate = date('Y-m-d H:i:s', strtotime($request->from));
        $toDate = date('Y-m-d H:i:s', strtotime('+23 hour +59 minutes +59 seconds', strtotime($request->to)));

        if ('audit' == $request->type) {
            return Excel::download(new AuditApplicantsExport($fromDate, $toDate), 'applicants.xlsx');
        }
        if ('dcms' == $request->type) {
            return Excel::download(new DCMSApplicantsExport($fromDate, $toDate), 'applicants.xlsx');
        }
        if ('check' == $request->type) {
            return Excel::download(new PruDnaAmlCheckApplicantsExport($fromDate, $toDate), 'applicants.xlsx');
        }

        return Excel::download(new ApplicantsExport($fromDate, $toDate), 'applicants.xlsx');
    }

    public function applicantsImport(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        // get imported data
        $imported = (new ApplicantsImport())->toCollection($request->file('file'));

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
        $import = new ApplicantsImport();
        Excel::import($import, $request->file('file'));

        // get imported result
        $updated = collect([$import->getImportResult()]);

        $filename = 'ImportHistory'.date('dMY').'_'.date('his').'.xlsx';
        Excel::store(new ImportBackupExport($org_data, $updated), $filename, 'upload');

        // save filename to db
        $history = new ImportHistory();
        $history->file_name = $filename;
        $history->save();

        return redirect('/setting')->with('status', 'Successfully Imported.');
    }

    public function applicantExport($type, Request $request)
    {
        if ('pdf' == $type) {
            return Excel::download(new ApplicantExport('pdf', $request->id), 'applicant.pdf');
        }

        return Excel::download(new ApplicantExport('excel', $request->id), 'applicant.xlsx');
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
