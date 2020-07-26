<?php

namespace App;

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
    protected $casts = [
        'education' => 'array',
        'working_experience' => 'array',
    ];

    protected $appends = ['age'];

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function interviews()
    {
        return $this->hasMany('App\Interview', 'applicants_id');
    }

    public function getInterviewScheduleAttribute()
    {
        return $this->interviews()->where('rescheduled', 0)->latest()->first();
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->dob)->age;
    }

    public function getGenderAttribute($value)
    {
        return 1 === $value ? 'Male' : 'Female';
    }

    public function scopeState($query, string $current_status = null, string $status_id = null)
    {
        return $query->where('current_status', $current_status)
            ->where('status_id', $status_id)
        ;
    }
}
