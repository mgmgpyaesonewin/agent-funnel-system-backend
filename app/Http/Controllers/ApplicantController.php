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
use Log;

class ApplicantController extends Controller
{
    public function preFilterPage(Request $request)
    {
        $statuses = Status::get();

        return view('pages.applicants.pre_filter', compact('statuses'));
    }

    public function pruDNAFilter(Request $request)
    {
        $statuses = Status::get();

        return view('pages.applicants.pru_dna_filter', compact('statuses'));
    }

    public function pmliFilter(Request $request)
    {
        $statuses = Status::get();

        return view('pages.applicants.pmli_filter', compact('statuses'));
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
        $applicants = Applicant::query()
            ->with('admin', 'bdm', 'ma', 'staff')
            ->state($request->current_status, $request->status_id)
            ->select(
                'id',
                'name',
                'phone',
                'dob',
                'gender',
                'current_status',
                'status_id',
                'assign_admin_id',
                'assign_bdm_id',
                'assign_ma_id',
                'assign_staff_id'
            )->paginate(10);

        return ApplicantResource::collection($applicants);
    }

    public function scheduleAppointment(Request $request)
    {
        $appointment = Carbon::parse("{$request->date} {$request->time}");
        $applicant_id = $request->applicant_id;

        $record = [
            'appointment' => $appointment,
            'url' => $request->url,
            'rescheduled' => 0,
            'applicant_id' => $applicant_id,
        ];

        Interview::create($record);

        // Set state from Filtered to Invited
        Applicant::where('id', $applicant_id)->update([
            'current_status' => 'pmli_filter',
            'status_id' => 1,
        ]);

        // Mail::to($applicant->email)->send(new SendWebinarNotification($applicant));

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
        $current_status = $request->current_status;
        $status_id = $request->status_id;

        $applicant = Applicant::where('id', $request->id)->first();
        $applicant->current_status = $current_status;
        $applicant->status_id = $status_id;
        $applicant->statuses()->attach($status_id, ['current_status' => $current_status]);
        $applicant->save();

        Log::info('updating applicant');
        // Mail::to($applicant->email)->send(new SendStatusNotification($applicant));

        return response()->json([
            'status' => true,
            'message' => 'Successfully Saved',
            'applicant_id' => $applicant->id,
        ]);
    }

    public function updateTrack(Request $request)
    {
        $applicant_id = $request->id;
        $trainings = $request->training_ids;

        $applicant = Applicant::find($applicant_id);
        $applicant->trainings()->sync($trainings);

        return response()->json([
            'status' => true,
            'message' => 'Successfully Saved',
        ]);
    }

    public function assignUserAsAdminForApplicant(Request $request)
    {
        $user_id = $request->user_id;
        $applicant_ids = $request->applicants_ids;
        $table_role_column = $request->role;

        $applicant_ids = collect($applicant_ids);
        $applicant_ids->map(function ($applicant_id) use ($user_id, $table_role_column) {
            Applicant::where('id', $applicant_id)->update([
                $table_role_column => $user_id,
            ]);
        });

        return response()->json([
            'status' => true,
            'message' => 'Successfully Updated',
        ]);
    }
}
