<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\User\Models\User;

class FreelancerEducation extends Model
{
    protected $table = 'freelancer_educations';
    protected $fillable = [
        'freelancer_id','school','degree','from','to'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * 
     */
    public function freelancer()
    {
        return $this->hasOne(Freelancer::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * 
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
