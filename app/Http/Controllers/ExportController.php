<?php

namespace App\Http\Controllers;

use App\Applicant;
use App\Contract;
use App\Exports\ApplicantExport;
use App\Exports\ApplicantsExport;
use App\Exports\AuditApplicantsExport;
use App\Exports\DCMSApplicantsExport;
use App\Exports\ImportBackupExport;
use App\Exports\PMLIFilterExport;
use App\Exports\PruDnaAmlCheckApplicantsExport;
use App\ImportHistory;
use App\Imports\ApplicantsImport;
use App\Setting;
use Carbon\Carbon;
use DB;
use DOMPDF;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
            return Excel::download(new AuditApplicantsExport($fromDate, $toDate), 'ApplicantsAuditExport'.date('dMY').'.xlsx');
        }
        if ('dcms' == $request->type) {
            return Excel::download(new DCMSApplicantsExport($fromDate, $toDate), 'ApplicantsForDCMS'.date('dMY').'.xlsx');
        }
        if ('check' == $request->type) {
            return Excel::download(new PruDnaAmlCheckApplicantsExport($fromDate, $toDate), 'ApplicantsforCheck'.date('dMY').'.xlsx');
        }

        return Excel::download(new ApplicantsExport($fromDate, $toDate), 'ApplicantsForImport'.date('dMY').'.xlsx');
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
            'partner_id',
            'utm_source'
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
        $contract = Contract::where('version', 1)->where('applicant_id', 2)->first();
        $applicant->document = Setting::where('meta_key', 'document_en')->first()->meta_value;
        $applicant->agreement_no = $contract->agreement_no;
        $applicant->applicant_sign_img = $contract->applicant_sign_img;
        $applicant->witness_sign_img = $contract->witness_sign_img;
        $applicant->witness_name = $contract->witness_name;
        $applicant->signed_date = Carbon::parse($contract->signed_date)->format('d-m-Y');
        // $applicant->contractor_signature = json_decode(Setting::where('meta_key', 'contractor_signature')->first()->meta_value);
        // $applicant->witness_signature = json_decode(Setting::where('meta_key', 'witness_signature')->first()->meta_value);

        view()->share('applicant', $applicant);
        $pdf = DOMPDF::loadView('pages.pdf', $applicant);

        return $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->stream('contract.pdf');
    }

    public function pdfView(Request $request)
    {
        $applicant = Applicant::where('id', 601)->first();
        $applicant->agreement_no = $applicant->temp_id;
        $contract = Contract::where('version', 1)->where('applicant_id', 601)->first();
        $applicant->document = Setting::where('meta_key', 'document_en')->first()->meta_value;
        $applicant->agreement_no = $contract->agreement_no;
        $applicant->applicant_sign_img = $contract->applicant_sign_img;
        $applicant->witness_sign_img = $contract->witness_sign_img;
        $applicant->witness_name = $contract->witness_name;
        $applicant->signed_date = Carbon::parse($contract->signed_date)->format('d-m-Y');
        $applicant->contractor_signature = json_decode(Setting::where('meta_key', 'contractor_signature')->first()->meta_value);
        $applicant->witness_signature = json_decode(Setting::where('meta_key', 'witness_signature')->first()->meta_value);

        return view('pages.pdf', compact('applicant'));
    }
}
