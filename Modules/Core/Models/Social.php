<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\User\Models\User;

class Social extends Model
{

    protected $fillable = [
        'user_id','provider','social_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * 
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
