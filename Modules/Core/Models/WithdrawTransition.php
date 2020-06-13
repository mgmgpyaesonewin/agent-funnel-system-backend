<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\User\Models\User;

class WithdrawTransition extends Model
{
    public $timestamps = false;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
