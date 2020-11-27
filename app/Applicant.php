<?php

namespace App;

use App\Events\ApplicantUpdating;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * App\Applicant.
 *
 * @property int                             $id
 * @property string                          $name
 * @property string                          $photo
 * @property string                          $nrc
 * @property string                          $dob
 * @property int                             $gender
 * @property string                          $phone
 * @property string                          $email
 * @property string                          $address
 * @property mixed                           $education
 * @property mixed                           $working_experience
 * @property int                             $is_chatesat_freelancer
 * @property string                          $referral_code
 * @property string                          $cv_attachment
 * @property int                             $is_webinar_available
 * @property int                             $is_training_available
 * @property int                             $is_prudential_available
 * @property int                             $status_id
 * @property null|int                        $reason_id
 * @property null|\Illuminate\Support\Carbon $created_at
 * @property null|\Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereCvAttachment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereDob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereEducation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereIsChatesatFreelancer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereIsPrudentialAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereIsTrainingAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereIsWebinarAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereNrc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereReasonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereReferralCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereWorkingExperience($value)
 * @mixin \Eloquent
 * @property string|null $temp_id
 * @property string|null $preferred_name
 * @property string|null $nrc_front_img
 * @property string|null $nrc_back_img
 * @property int $myanmar_citizen
 * @property string|null $citizen
 * @property string|null $race
 * @property string|null $married
 * @property int|null $city_id
 * @property int|null $township_id
 * @property string|null $secondary_phone
 * @property int $accept_t_n_c
 * @property string|null $spouse_name
 * @property string|null $spouse_nrc
 * @property string|null $spouse_occupation
 * @property string|null $spouse_company_name
 * @property mixed|null $prudential_agency_exp
 * @property mixed|null $employment
 * @property mixed|null $agent_exp
 * @property mixed|null $family_agent
 * @property mixed $additional_info
 * @property string|null $utm_source
 * @property string|null $utm_medium
 * @property string|null $utm_campaign
 * @property string|null $utm_term
 * @property string $exam_date
 * @property string|null $username
 * @property string|null $password
 * @property string|null $e_learning
 * @property int $aml_check
 * @property string|null $payment
 * @property string $current_status
 * @property int|null $partner_id
 * @property int|null $assign_admin_id
 * @property int|null $assign_bdm_id
 * @property int|null $assign_ma_id
 * @property int|null $assign_staff_id
 * @property string $agent_code
 * @property int $correct_info
 * @property string|null $submitted_date
 * @property string|null $certificate
 * @property string $bank_account_no
 * @property string $bank_account_name
 * @property string $banK_name
 * @property string|null $bank_branch_name
 * @property string $swift_code
 * @property string $license_no
 * @property string $license_photo_1
 * @property string $pdf
 * @property string $uuid
 * @property string $license_photo_2
 * @property string|null $agreement_no
 * @property string|null $signed_date
 * @property string|null $sign_img
 * @property-read \App\User|null $admin
 * @property-read \App\User|null $bdm
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\BopSession[] $bop_sessions
 * @property-read int|null $bop_sessions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Contract[] $contracts
 * @property-read int|null $contracts_count
 * @property-read mixed $age
 * @property-read mixed $interview_schedule
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Interview[] $interviews
 * @property-read int|null $interviews_count
 * @property-read \App\User|null $ma
 * @property-read \App\Partner|null $partner
 * @property-read \App\User|null $staff
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Status[] $statuses
 * @property-read int|null $statuses_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Training[] $trainings
 * @property-read int|null $trainings_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant filter($name = null, $phone = null, $aml_status = null, $date = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant role($auth)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant state($current_status = null, $status_ids_arr = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereAcceptTNC($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereAdditionalInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereAgentCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereAgentExp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereAgreementNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereAmlCheck($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereAssignAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereAssignBdmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereAssignMaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereAssignStaffId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereBanKName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereBankAccountName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereBankAccountNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereBankBranchName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereCertificate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereCitizen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereCorrectInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereCurrentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereELearning($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereEmployment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereExamDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereFamilyAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereLicenseNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereLicensePhoto1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereLicensePhoto2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereMarried($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereMyanmarCitizen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereNrcBackImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereNrcFrontImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant wherePartnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant wherePayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant wherePdf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant wherePreferredName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant wherePrudentialAgencyExp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereRace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereSecondaryPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereSignImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereSignedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereSpouseCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereSpouseName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereSpouseNrc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereSpouseOccupation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereSubmittedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereSwiftCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereTempId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereTownshipId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereUtmCampaign($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereUtmMedium($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereUtmSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereUtmTerm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Applicant whereUuid($value)
 */
class Applicant extends Model
{
    // protected $fillable = ['temp_id'];
    protected $guarded = [];
    protected $casts = [
        'working_experience' => 'array',
    ];

    protected $appends = ['age'];

    protected $dispatchesEvents = [
        'updating' => ApplicantUpdating::class,
    ];

    public function statuses()
    {
        return $this->belongsToMany('App\Status')->withPivot('current_status', 'user_id')->withTimestamps();
    }

    public function activatedYesterday()
    {
        return $this->belongsToMany('App\Status')->withPivot('current_status', 'user_id')
            ->withTimestamps()
            ->wherePivot('status_id', 8)
            ->wherePivot(
                'current_status',
                'active'
            )->wherePivot('created_at', '>=', Carbon::now()->subHours(24));
    }

    public function bop_sessions()
    {
        return $this->belongsToMany('App\BopSession')->withPivot('attendance_status')->withTimestamps();
    }

    public function interviews()
    {
        return $this->hasMany('App\Interview', 'applicants_id');
    }

    public function partner()
    {
        return $this->belongsTo('App\Partner');
    }

    public function admin()
    {
        return $this->belongsTo('App\User', 'assign_admin_id');
    }

    public function bdm()
    {
        return $this->belongsTo('App\User', 'assign_bdm_id');
    }

    public function ma()
    {
        return $this->belongsTo('App\User', 'assign_ma_id');
    }

    public function staff()
    {
        return $this->belongsTo('App\User', 'assign_staff_id');
    }

    public function trainings()
    {
        return $this->belongsToMany('App\Training');
    }

    public function contracts()
    {
        return $this->hasMany('App\Contract');
    }

    public function getInterviewScheduleAttribute()
    {
        return $this->interviews()->where('rescheduled', 0)->latest()->first();
    }

    public function getUtmSourceAttribute($value)
    {
        return reverse_slug($value);
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->dob)->age;
    }

    public function getGenderAttribute($value)
    {
        return 0 === $value ? 'Male' : 'Female';
    }

    public function getAmlCheckAttribute($value)
    {
        if ($value > 0) {
            return 1 === $value ? 'Passed' : 'Failed';
        }

        return 'Pending';
    }

    public function scopeState($query, string $current_status = null, array $status_ids_arr = null)
    {
        return $query->when($current_status, function ($query) use ($current_status) {
            return $query->where('current_status', $current_status);
        })->when($status_ids_arr, function ($query) use ($status_ids_arr) {
            return $query->whereIn('status_id', $status_ids_arr);
        });
    }

    public function scopeFilter($query, string $name = null, string $phone = null, array $aml_status = null, string $date = null)
    {
        return $query->when($name, function ($query, $name) {
            return $query->where('name', 'like', "%{$name}%");
        })->when($phone, function ($query, $phone) {
            return $query->where('phone', $phone);
        })->when($aml_status, function ($query, $aml_status) {
            return $query->whereIn('aml_check', $aml_status);
        })->when($date, function ($query, $date) {
            return $query->where('exam_date', $date);
        });
    }

    public function scopeRole($query, $auth)
    {
        $user = User::where('id', $auth->id)->first();

        return $query->when($user->partner_id, function ($query) use ($user) {
            return $query->where('partner_id', $user->partner_id);
        })->when(1 === $user->is_bdm, function ($query) use ($user) {
            return $query->where('assign_bdm_id', $user->id);
        })->when(1 === $user->is_ma, function ($query) use ($user) {
            return $query->where('assign_ma_id', $user->id);
        });
    }

    public function saveQuietly(array $options = [])
    {
        return static::withoutEvents(function () use ($options) {
            return $this->save($options);
        });
    }

    public function inviteBopSession($session_id)
    {
        $this->bop_sessions()->attach($session_id, [
            'attendance_status' => 'invited',
        ]);
    }

    public function getEffectiveDate()
    {
        return $this->statuses()
            ->wherePivot('status_id', 8)
            ->wherePivot('current_status', 'active')
            ->first()->pivot->created_at ?? null;
    }

    public function getLicenseExamPassDate()
    {
        return $this->statuses()
            ->wherePivot('status_id', 1)
            ->wherePivot('current_status', 'onboard')
            ->first()->pivot->created_at ?? null;
    }

    public function getContractSignedDate()
    {
        return $this->contracts()->latest()->first()->created_at ?? null;
    }

    public function isMarried()
    {
        return Str::lower($this->married) != 'single';
    }

    public function hasSpouse()
    {
        if ($this->isMarried()) {
            return isset($this->spouse_name);
        }
        return false;
    }

    public function getPreviousCompanyData()
    {
        $employment = json_decode($this->employment);

        if ($this->validEmployment($employment)) {
            $employment = collect($employment);
            return $employment->sortByDesc(function ($emp) {
                return  strtotime($emp->duration_to_date);
            })->first();
        }
    }

    public function validEmployment($employment)
    {
        if (isset($employment) && count($employment) >= 0) {
            return true;
        }
        return false;
    }

    public function getCitizenship()
    {
        if ($this->myanmar_citizen == 1) {
            return 'Myanmar';
        }
        return $this->citizen;
    }

    public function getStateCode()
    {
        return DB::table('city_descriptions')->where('c_id', $this->city_id)
            ->first()->value ?? null;
    }
}
