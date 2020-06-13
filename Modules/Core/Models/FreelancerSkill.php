<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;

class FreelancerSkill extends Model
{
    protected $fillable = [
        'freelancer_id',
        'skill_id'
    ];
}
