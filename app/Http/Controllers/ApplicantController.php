<?php

namespace App\Http\Controllers;

use App\Applicant;
use App\Contract;
use App\Http\Requests\UserApiRequest;
use App\Http\Resources\ApplicantResource;
use App\Interfaces\ContractInterface;
use App\Interview;
use App\Partner;
use App\Setting;
use App\Status;
use App\Training;
use Carbon\Carbon;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PDF;
use DB;

class ApplicantController extends Controller
{
    public function signContract(Request $req)
    {
        $applicant = Applicant::where('uuid', $req->id)->first();
        $applicant->agent_code = $this->generateAgentCode($applicant->id);
        $applicant->save();

        $applicant_sign = Storage::disk('public')->put('sign/applicant', $req->applicant_url);
        $witness_sign_img = Storage::disk('public')->put('sign/witness', $req->witness_url);

        $contract = Contract::where('version', $req->version)->where('applicant_id', $applicant->id)->first();
        $contract->agreement_no = $applicant->temp_id;
        $contract->signed_date = Carbon::now();
        $contract->applicant_sign_img = $applicant_sign;
        $contract->witness_name = $req->witness_name;
        $contract->witness_sign_img = $witness_sign_img;
        $contract->save();

        $applicant->document = Setting::where('meta_key', 'document_en')->first()->meta_value;
        $applicant->agreement_no = $contract->agreement_no;
        $applicant->applicant_sign_img = $contract->applicant_sign_img;
        $applicant->witness_sign_img = $contract->witness_sign_img;
        $applicant->witness_name = $contract->witness_name;

        view()->share('applicant', $applicant);
        $pdf = PDF::loadView('pages.pdf', $applicant);

        $contract_pdf = $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->download()->getOriginalContent();
        $file = 'contracts/'.$applicant->phone.'-'.Carbon::now()->format('d_m_y_h_m_s').'.pdf';
        Storage::disk('public')->put($file, $contract_pdf);

        $contract->pdf = $file;
        $contract->save();

        return response()->json([
            'contract' => asset('storage/'.$file),
        ]);
    }

    public function generateAgentCode($applicant_id)
    {
        $raw_agent_code = "2".str_pad($applicant_id, 6, "0", STR_PAD_LEFT);
        $agent_code = "0".number_format($raw_agent_code);
        return $agent_code;
    }

    public function detail(Request $req)
    {        
        $appli = Applicant::where('uuid', $req->id)->first();
        $appli->name = $req->name;
        $appli->dob = $req->dob;
        $appli->phone = str_replace('-', '', $req->contact_no);
        $appli->secondary_phone = $req->alternate_no;
        $appli->gender = $appli->gender;
        $appli->preferred_name = $req->preferred_name;
        $appli->nrc = $req->nrc;
        $file = $req->file('nrc_front');
        if ($req->hasFile('nrc_front')) {
            $url = Storage::disk('public')->put('nrc_photo', $file);
            $appli->nrc_front_img = $url;
        }
        $file = $req->file('nrc_back');
        if ($req->hasFile('nrc_back')) {
            $url = Storage::disk('public')->put('nrc_photo', $file);
            $appli->nrc_back_img = $url;
        }
        $appli->myanmar_citizen = $req->myanmar_citizen;
        $appli->citizen = $req->citizen;
        $appli->race = $req->race;
        $appli->married = $req->marital_status;
        $appli->address = $req->address;

        $appli->city_id = $req->city;
        $appli->township_id = $req->township;
        $appli->education = $req->highest_qualification;
        $appli->email = $req->email;
        $appli->accept_t_n_c = 1;
        $appli->additional_info = $req->additional_info;
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

    public function Access_SignBoard(Request $req, ContractInterface $contractI)
    {
        $contract_valid = $contractI->isValidContract($req->id, (int) $req->version);
        if ($contract_valid) {
            $contract = Setting::where('meta_key', "document_{$req->lang}")->first()->meta_value;

            return [
                'message' => 'valid',
                'contract' => $contract
            ];
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
                $url = Storage::disk('public')->put('licenses', $file);
                $data['license_photo_'.$index] = $url;
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
            ->first()
        ;
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
        $applicant->uuid = (string) Str::uuid();
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

        return  Applicant::create($data)
            ->statuses()
            ->attach(1, ['current_status' => 'pre_filter'])
        ;
    }

    public function savePayment(Request $request)
    {
        $file = $request->file('file');
        $applicant = Applicant::where('nrc', $request->nrc)->first();
        $url = Storage::disk('public')->put('payments', $file);

        if ($applicant) {
            $applicant->payment = $url;
            $applicant->save();

            return response()->json([
                'status' => true,
                'message' => 'Successfully Created',
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Invalid User',
        ]);
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
            ->with('admin', 'bdm', 'ma', 'staff', 'partner', 'contracts')
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
                'partner_id',
                'payment',
                'license_photo_1',
                'license_photo_2',
                'pdf',
                'utm_source'
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
        $text = json_decode(Setting::where('meta_key', 'interview_msg')->first()->meta_value)->text." Date : {$appointment->format('jS \\of F Y \\(l\\) h:i A')} | Link: {$request->url}";

        notified_applicant_via_viber($applicant->phone, $text);

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
        $applicant = Applicant::with('trainings')->where('id', $request->id)->first();
        $trainings = Training::all();
        $activities = DB::table('applicant_status')->select('status_id','current_status', 'name', 'applicant_status.created_at')
                        ->leftjoin('users', 'users.id', 'applicant_status.user_id')
                        ->where('applicant_id', $request->id)
                        ->get();

        return view('pages.applicants.detail', compact('applicant', 'trainings', 'activities'));
    }

    public function update(Request $request, ContractInterface $contract)
    {
        $current_status = $request->current_status;
        $status_id = $request->status_id;

        $applicant = Applicant::where('id', $request->id)->first();
        $applicant->current_status = $current_status;
        $applicant->status_id = $status_id;

        if ('onboard' == $current_status && 7 == $status_id) {
            $contract_version = $contract->resendContract($applicant->id);
            $route = env('FRONT_END_URL').'/sign/'.$applicant->uuid.'?version='.$contract_version;
            $link = $route;
            $this->text = json_decode(Setting::where('meta_key', 'contract_msg')->first()->meta_value)->text."{$link}";
            notified_applicant_via_viber($applicant->phone, $this->text);
        }

        if ('pmli_filter' == $current_status && 11 == $status_id) {
            $route = env('FRONT_END_URL').'/payment/'.$applicant->uuid;
            $link = $route;
            $this->text = json_decode(Setting::where('meta_key', 'payment_msg')->first()->meta_value)->text."{$link}";
            notified_applicant_via_viber($applicant->phone, $this->text);
        }

        $applicant->statuses()->attach($status_id, [
            'current_status' => $current_status,
            'user_id' => auth()->user()->id
        ]);
        
        $applicant->save();

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
            $applicant->statuses()->attach(3, ['current_status' => 'training']);
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

        $applicant = Applicant::where('id', $applicant_id)->first();
        $text = json_decode(Setting::where('meta_key', 'exam_msg')->first()->meta_value)->text." {$exam_date}";

        notified_applicant_via_viber($applicant->phone, $text);

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
        $text = json_decode(Setting::where('meta_key', 'cv_form_msg')->first()->meta_value)->text." Login into here : {$applicant->e_learning} using this username : {$applicant->username} and password : {$request->password}";
        notified_applicant_via_viber($applicant->phone, $text);

        return response()->json([
            'status' => true,
            'message' => 'Successfully saved',
        ]);
    }

    public function validatePayment(Request $request)
    {
        return Applicant::where('uuid', $request->uuid)->firstOrFail();
    }
}
