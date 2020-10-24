<?php

namespace App;

use App\Events\ApplicantUpdating;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

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
 *
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
 */
class Applicant extends Model
{
    // protected $fillable = ['temp_id'];
    protected $guarded = [];
    protected $casts = [
        'education' => 'array',
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
}
