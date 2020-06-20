<?php

namespace App\Http\Controllers;

use App\Applicant;
use App\Http\Resources\ApplicantResource;
use App\Status;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    public function pendingPage(Request $request)
    {
        $statuses = Status::get();

        return view('pages.applicants.pending', compact('statuses'));
    }

    public function screenedPage(Request $request)
    {
        $statuses = Status::get();

        return view('pages.applicants.screened', compact('statuses'));
    }

    public function onboardedPage(Request $request)
    {
        $statuses = Status::get();

        return view('pages.applicants.onboarded', compact('statuses'));
    }

    public function traineePage(Request $request)
    {
        $statuses = Status::get();

        return view('pages.applicants.trainee', compact('statuses'));
    }

    public function qualifiedPage(Request $request)
    {
        $statuses = Status::get();

        return view('pages.applicants.qualified', compact('statuses'));
    }

    public function applicants(Request $request)
    {
        $name = empty($request->name) ? null : $request->name;
        $email = empty($request->email) ? null : $request->email;

        $applicants = Applicant::when($name, function ($q) use ($name) {
            return $q->where('name', 'LIKE', "%{$name}%");
        })->when($email, function ($q) use ($email) {
            return $q->where('email', 'LIKE', "%{$email}%");
        })->where('status_id', $request->status)->paginate(10);

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
