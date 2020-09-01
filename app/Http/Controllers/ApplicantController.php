<?php

namespace App\Http\Controllers;

use App\Applicant;
use App\Http\Requests\UserApiRequest;
use App\Http\Resources\ApplicantResource;
use App\Interview;
use App\Mail\SendStatusNotification;
use App\Mail\SendWebinarNotification;
use App\Partner;
use App\Status;
use App\Training;
use Carbon\Carbon;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Log;

class ApplicantController extends Controller
{
    public function test(Request $req)
    {
        $appli = Applicant::where('uuid', $req->id)->first();
        // return $appli;
        $url = Storage::disk('local')->put('contracts', $req->pdf);
        $appli->pdf = $url;
        $appli->save();
        return $url;
    }

    public function detail(Request $req)
    {

        // return $req->file('nrc_back');
        $appli = Applicant::where('uuid', $req->id)->first();
        $appli->name = $req->name;
        $appli->dob = $req->dob;
        $appli->phone = $req->phone;
        $appli->secondary_phone = $req->alternate_no;
        $appli->gender = $appli->gender;
        $appli->preferred_name = $req->preferred_name;
        $appli->nrc = $req->nrc;
        $file = $req->file('nrc_front');
        if ($req->hasFile('nrc_front')) {
            $url = Storage::disk('local')->put('nrc_photo', $file);
            $appli->nrc_front_img = $url;
        }
        $file = $req->file('nrc_back');
        if ($req->hasFile('nrc_back')) {
            $url = Storage::disk('local')->put('nrc_photo', $file);
            $appli->nrc_back_img = $url;
        }
        $appli->myanmar_citizen = $req->myanmar_citizen;
        $appli->citizen = $req->citizen;
        $appli->race = $req->race;
        $appli->married = $req->marital_status;
        $appli->address = $req->address;

        $appli->city_id = $req->city;
        $appli->township_id - $req->township;
        $appli->education = $req->highest_qualification;
        $appli->email = $req->email;
        $appli->accept_t_n_c = 1;
        $appli->save();
        return $appli;
    }
    public function spouse_update(Request $req)
    {
        // return $req->all();
        $appli = Applicant::where('uuid', $req->id)->first();
        $appli->update(collect($req->spouse)->except('term_condition')->toArray());
        return $appli;
    }

    public function Access_SignBoard(Request $req)
    {
        $appli = Applicant::where('uuid', $req->id)->first();
        if ($appli) {
            return ['message' => 'valid'];
        }
        return response(['message' => 'invalid'], 422);
    }

    public function bank_info_update(Request $req)
    {
        $appli = Applicant::find($req->id);
        $data['bank_account_no'] = $req->account_no;
        $data['bank_account_name'] = $req->name;
        $data['bank_name'] = $req->bank_name;
        $data['license_no'] = $req->license_number;
        // // return $data;
        $files = $req->file('license_photo');
        if ($req->hasFile('license_photo')) {
            foreach ($files as $key => $file) {
                $index = $key + 1;
                $url = Storage::disk('local')->put('licenses', $file);
                $data['license_photo_' . $index] = $url;
            }
        }
        $appli->update($data);

        return $appli;
    }

    public function login(Request $req)
    {
        // return $req->all();
        $valid_appli = Applicant::where('temp_id', $req->tempid)
            ->where('dob', $req->dob)
            ->first();
        if ($valid_appli) {
            return $valid_appli;
        }

        return response(['message' => 'Invalid ID or Date of Birth'], 401);
    }

    public function leadPage(Request $request)
    {
        $statuses = Status::whereIn('id', [1, 4])->get();

        return view('pages.applicants.lead', compact('statuses'));
    }

    public function create_lead()
    {
        return view('pages.applicants.create_lead');
    }

    public function store(Request $request)
    {
        $applicant = new Applicant();
        $applicant->name = $request->name;
        $applicant->phone = $request->phone;
        $applicant->dob = $request->dob;
        $applicant->gender = $request->gender;
        $applicant->current_status = 'lead';
        $applicant->status_id = '1';

        if (null != auth()->user()->partner_id) {
            $partner = Partner::find(auth()->user()->partner_id);
            $applicant->utm_source = $partner->company_name;
        }

        $applicant->save();

        return redirect('/lead')->with('status', 'Successfully created new lead');
    }

    public function preFilterPage(Request $request)
    {
        $statuses = Status::whereIn('id', [1, 4])->get();

        return view('pages.applicants.pre_filter', compact('statuses'));
    }

    public function createuser(UserApiRequest $req)
    {
        $data = $req->validated();
        $data['phone'] = str_replace('-', '', $data['phone']);
        $data['current_status'] = 'lead';
        $data['status_id'] = 1;
        $data['uuid'] = (string) Str::uuid();

        return  Applicant::create($data);
    }

    public function pruDNAFilter(Request $request)
    {
        $statuses = Status::whereIn('id', [1, 4, 5])->get();

        return view('pages.applicants.pru_dna_filter', compact('statuses'));
    }

    public function pmliFilter(Request $request)
    {
        $statuses = Status::whereIn('id', [1, 4])->get();

        return view('pages.applicants.pmli_filter', compact('statuses'));
    }

    public function onboardedPage(Request $request)
    {
        $statuses = Status::whereIn('id', [1, 4])->get();

        return view('pages.applicants.onboarded', compact('statuses'));
    }

    public function traineePage(Request $request)
    {
        $statuses = Status::whereIn('id', [1, 4])->get();

        return view('pages.applicants.trainee', compact('statuses'));
    }

    public function certificationPage(Request $request)
    {
        $statuses = Status::whereIn('id', [1, 4])->get();

        return view('pages.applicants.certification', compact('statuses'));
    }

    public function contractPage(Request $request)
    {
        $statuses = Status::whereIn('id', [1, 8, 9, 10])->get();

        return view('pages.applicants.contract', compact('statuses'));
    }

    public function applicants(Request $request)
    {
        $applicants = Applicant::query()
            ->with('admin', 'bdm', 'ma', 'staff', 'partner')
            ->role(auth()->user())
            ->state($request->current_status, $request->status_id)
            ->filter($request->name, $request->phone, $request->aml_status, $request->date)
            ->orderBy('id')
            ->select(
                'id',
                'name',
                'temp_id',
                'phone',
                'dob',
                'gender',
                'exam_date',
                'aml_check',
                'current_status',
                'status_id',
                'assign_admin_id',
                'assign_bdm_id',
                'assign_ma_id',
                'assign_staff_id',
                'partner_id'
            )->paginate(35);

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

        // Set state from Passed to PMLI Stage
        Applicant::where('id', $applicant_id)->update([
            'current_status' => 'pmli_filter',
            'status_id' => 1,
        ]);

        // Mail::to($applicant->email)->send(new SendWebinarNotification($applicant));
        $applicant = Applicant::where('id', $applicant_id)->first();

        // Stage 5
        notified_applicant_via_viber($applicant->phone, "{$appointment}, {$request->url}");

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

        $applicant_training_sessions = Applicant::withCount('trainings')->where('id', $applicant_id)->first()->trainings_count;
        $no_of_training_sessions = Training::count();

        if ($applicant_training_sessions >= $no_of_training_sessions) {
            $applicant->current_status = 'training';
            $applicant->status_id = 3;
            $applicant->saveQuietly();
        }

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

    public function addExamForApplicants(Request $request)
    {
        $applicant_ids = $request->applicant_ids;
        $exam_date = $request->exam_date;

        $applicant_ids = collect($applicant_ids);

        $applicant_ids->map(function ($applicant_id) use ($exam_date) {
            Applicant::where('id', $applicant_id)->update([
                'exam_date' => $exam_date,
            ]);
        });

        return response()->json([
            'status' => true,
            'message' => 'Successfully Saved',
        ]);
    }

    public function addExamForApplicant(Request $request)
    {
        $applicant_id = $request->applicant_id;
        $exam_date = $request->exam_date;

        Applicant::where('id', $applicant_id)->update([
            'exam_date' => $exam_date,
            'current_status' => 'certification',
            'status_id' => 1,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Successfully Saved',
        ]);
    }

    public function updateAML(Request $request)
    {
        $data = [
            'aml_check' => $request->aml_status,
        ];

        if (0 == $request->aml_status) {
            $data['status_id'] = 4;
        }

        Applicant::whereIn('id', $request->ids)->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Successfully Saved',
        ]);
    }

    public function saveELearningInfo(Request $request)
    {
        Applicant::where('id', $request->id)->update([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'e_learning' => $request->url,
        ]);

        // Send E-Learning Info
        $applicant = Applicant::where('id', $request->id)->first();
        notified_applicant_via_viber($applicant->phone, "E-Learning Link {$applicant->e_learning}, Username is {$applicant->username}, Password is {$request->password}");

        return response()->json([
            'status' => true,
            'message' => 'Successfully saved',
        ]);
    }
}
