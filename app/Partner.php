<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = ['company_name', 'pic_name', 'pic_phone', 'pic_email'];

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
