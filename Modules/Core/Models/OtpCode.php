<?php

namespace  Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class OtpCode extends Model
{
    protected $fillable = [
        'code', 'phone', 'status'
    ];

    public function scopeExpired($query)
    {
        $now = Carbon::now();
        return $query->where('created_at', '>', $now->subDays(4));
    }
}
