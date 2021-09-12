<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Training extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function applicants()
    {
        return $this->belongsToMany('App\Applicant');
    }

    public function scopeEnable($query)
    {
        return $query->where('enable', 1);
    }

    public function getTrainingTotalAssigned()
    {
        return DB::table('applicant_status')
            ->where('current_status', 'pmli_filter')
            ->where('status_id', '3')
            ->where('created_at', '>=', $this->created_at)
            ->count();
    }
}
