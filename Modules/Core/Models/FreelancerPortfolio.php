<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Models\Upload;
use Modules\User\Models\User;
use Modules\Freelancer\Models\Freelancer;

class FreelancerPortfolio extends Model
{
    protected $fillable = [
        'freelancer_id','upload_id'
    ];

    /**'
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * 
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * 
     */
    public function upload()
    {
        return $this->hasMany(Upload::class ,'id','upload_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * 
     */
    public function freelancer()
    {
        return $this->hasOne(Freelancer::class);
    }
}
