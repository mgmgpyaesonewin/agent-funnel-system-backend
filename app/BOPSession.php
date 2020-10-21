<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class BOPSession extends Model
{
    protected $guarded = [];

    public function getDate()
    {
        return Carbon::parse($this->session)->format('d-m-Y');
    }

    public function getTime()
    {
        return Carbon::parse($this->session)->format('h:i A');
    }

    public function applicants()
    {
        return $this->belongsToMany('App\Applicant')->withPivot('attendance_status')->withTimestamps();
    }
}
