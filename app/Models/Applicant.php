<?php

namespace App\Models;

use App\Events\ApplicantUpdating;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;

final class Applicant extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'working_experience' => 'array',
    ];

    protected $appends = ['age'];

    protected $dispatchesEvents = [
        'updating' => ApplicantUpdating::class,
    ];

    public function statuses(): BelongsToMany
    {
        return $this->belongsToMany(Status::class)->withPivot('current_status', 'user_id')->withTimestamps();
    }

    public function activatedYesterday()
    {
        return $this->belongsToMany(Status::class)->withPivot('current_status', 'user_id')
            ->withTimestamps()
            ->wherePivot('status_id', 8)
            ->wherePivot(
                'current_status',
                'active'
            )->wherePivot('created_at', '>=', Carbon::now()->subHours(24));
    }

    public function bop_sessions()
    {
        return $this->belongsToMany(BopSession::class)->withPivot('attendance_status')->withTimestamps();
    }

    public function interviews()
    {
        return $this->hasMany(Interview::class, 'applicants_id');
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'assign_admin_id');
    }

    public function bdm()
    {
        return $this->belongsTo(User::class, 'assign_bdm_id');
    }

    public function ma()
    {
        return $this->belongsTo(User::class, 'assign_ma_id');
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'assign_staff_id');
    }

    public function trainings()
    {
        return $this->belongsToMany(Training::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
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
