<?php

namespace App\Http\Controllers;

use App\Applicant;
use App\Http\Resources\ApplicantResource;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    public function pendingPage(Request $request)
    {
        return view('pages.applicants.pending');
    }

    public function applicants(Request $request)
    {
        $applicants = Applicant::where('status_id', $request->status)->paginate(10);

        return ApplicantResource::collection($applicants);
    }

    public function applicantsDetail(Request $request)
    {
        $applicant = Applicant::where('id', $request->id)->first();

        return view('pages.applicants.detail', compact('applicant'));
    }

    public function update(Request $request)
    {
        $old_status = $request->old_status;
        $new_status = $request->new_status;

        $applicant = Applicant::where('status_id', $old_status)->first();
        $applicant->status_id = $new_status;
        $applicant->reason_id = 12 == $new_status ? $request->reason_id : $applicant->reason_id;
        $applicant->save();

        return response()->json([
            'status' => true,
            'message' => 'Successfully Saved',
            'applicant_id' => $applicant->id,
        ]);
    }
}
