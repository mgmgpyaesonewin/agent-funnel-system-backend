<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Training extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function applicants()
    {
        return $this->belongsToMany('App\Applicant');
    }
}
