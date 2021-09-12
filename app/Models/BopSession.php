<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class BopSession extends Model
{
    use HasFactory;

    protected $table = 'bop_sessions';
    protected $guarded = [];

    public function getDate()
    {
        return Carbon::parse($this->session)->format('d-m-Y');
    }

    public function getViberDateFormat()
    {
        return Carbon::parse($this->session)->format('jS \\of F Y \\(l\\) h:i A');
    }

    public function getTime()
    {
        return Carbon::parse($this->session)->format('h:i A');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeEnable($query)
    {
        return $query->where('enable', 1);
    }

    public function applicants()
    {
        return $this->belongsToMany(Applicant::class, 'applicant_bop_session')->withPivot('attendance_status')->withTimestamps();
    }
}
