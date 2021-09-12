<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['date', 'amount', 'partner_id'];

    public function partner()
    {
        return $this->belongsTo('App\Partner');
    }
}
