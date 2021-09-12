<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public function applicants()
    {
        return $this->belongsToMany('App\Applicant')->withPivot('current_status')->withTimestamps();
    }
}
