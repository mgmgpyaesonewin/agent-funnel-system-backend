<?php

namespace App\Http\Controllers;

use App\Applicant;
use App\Http\Resources\ApplicantResource;
use App\Interview;
use App\Status;
use Carbon\Carbon;
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

    public function invitedPage(Request $request)
    {
        $statuses = Status::get();

        return view('pages.applicants.invited', compact('statuses'));
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
        })->whereIn('status_id', json_decode($request->status))->paginate(10);

        return ApplicantResource::collection($applicants);
    }

    public function scheduleAppointment(Request $request)
    {
        $appointment = Carbon::parse("{$request->date} {$request->time}");

        foreach ($request->applicants as $applicant_id) {
            $record = [
                'appointment' => $appointment,
                'url' => $request->url,
                'rescheduled' => 0,
                'applicants_id' => $applicant_id,
            ];

            Interview::create($record);

            // Set state from Filtered to Invited
            Applicant::where([['status_id', 3], ['id', $applicant_id]])->update(['status_id' => 4]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Successfully Created',
        ]);
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
