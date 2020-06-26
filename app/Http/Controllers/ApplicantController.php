<?php

namespace App\Http\Controllers;

use App\Applicant;
use App\Http\Resources\ApplicantResource;
use App\Interview;
use App\Mail\SendStatusNotification;
use App\Mail\SendWebinarNotification;
use App\Status;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mail;

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
        $status = empty($request->status) ? null : $request->status;

        $applicants = Applicant::when($name, function ($q) use ($name) {
            return $q->where('name', 'LIKE', "%{$name}%");
        })->when($email, function ($q) use ($email) {
            return $q->where('email', 'LIKE', "%{$email}%");
        })->whereIn('status_id', json_decode($status))->paginate(10);
        //dd($applicants);
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
            $applicant = Applicant::where('id', $applicant_id)->first();

            Mail::to($applicant->email)->send(new SendWebinarNotification($applicant));
        }

        return response()->json([
            'status' => true,
            'message' => 'Successfully Created',
        ]);
    }

    public function setupWebinar(Request $request)
    {
        $applicant = Applicant::where('id', $request->id)->first();
        $status_id = 'accept' === $request->type ? 5 : 12;
        $applicant->status_id = $status_id;
        $applicant->reason_id = 12 == $status_id ? 3 : $applicant->reason_id;
        $applicant->save();

        echo 'Successful!';
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

        $applicant = Applicant::where([['status_id', $old_status], ['id', $request->id]])->first();

        $applicant->status_id = $new_status;
        $applicant->reason_id = 12 == $new_status ? $request->reason_id : $applicant->reason_id;
        $applicant->save();

        Mail::to($applicant->email)->send(new SendStatusNotification($applicant));

        return response()->json([
            'status' => true,
            'message' => 'Successfully Saved',
            'applicant_id' => $applicant->id,
        ]);
    }
}
