<?php

namespace Modules\Report\Entities;

use Illuminate\Database\Eloquent\Model;

class NetPromoterScore extends Model
{
    protected $fillable = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}
