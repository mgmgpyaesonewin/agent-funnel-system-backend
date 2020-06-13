<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Modules\User\Models\User;

class Credit extends Model
{
    protected $fillable = ['amount','status','desc','user_id','currency'];

    protected $dates = ['promoted_at','approved_at','cancelled_at','created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * 
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
